import { cloneDeep, get, unset } from "lodash-es";
import { useEffect, useState } from "react";
import useForm from "./form-context";
import { FormFieldContext } from "./form-field-context";

type FormFieldProps = {
  conditions?: App.Http.Data.FormElementConditionData[];
  id: string;
  input: App.Http.Data.InputData;
  render: (field: {
    handle: string;
    placeholder?: string;
    value: unknown;
    onFieldChange: (value: unknown) => void;
  }) => React.ReactNode;
};

function FormField({ conditions, id, input, render }: FormFieldProps) {
  const { data, errors, setData } = useForm();

  const [visible, setVisible] = useState<boolean>(true);

  function getError() {
    return get(errors, id);
  }

  function getValue() {
    const defaultValue = (input.settings as Record<string, unknown>)?.value ?? "";

    return get(data, id, defaultValue);
  }

  useEffect(() => {
    if (get(data, id) === undefined) {
      setData?.(id, getValue());
    }
  }, []);

  useEffect(() => {
    let nextVisible = true;

    for (const condition of conditions || []) {
      if (data?.[condition.handle] !== condition.value) {
        nextVisible = false;
        break;
      }
    }

    if (nextVisible && !visible) {
      setVisible(true);
    } else if (!nextVisible && visible) {
      setData?.((data: Record<string, unknown>) => {
        const newData = cloneDeep(data);

        unset(newData, input.handle);

        return newData;
      });

      setVisible(false);
    }
  }, [data]);

  const contextValue = {
    ...input,
    error: getError(),
  };

  return visible ? (
    <FormFieldContext.Provider value={contextValue}>
      {render({
        handle: id,
        value: getValue(),
        onFieldChange: (value) => {
          setData?.(id, value);
        },
      })}
    </FormFieldContext.Provider>
  ) : null;
}

export default FormField;
