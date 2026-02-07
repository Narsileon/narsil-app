import { replaceLastPath } from "@narsil-cms/lib/utils";
import { cloneDeep, get, unset } from "lodash-es";
import { type ReactNode, useEffect, useState } from "react";
import useForm from "./form-context";
import { FormFieldContext } from "./form-field-context";

type FormFieldProps = App.Http.Data.FormElementData & {
  element: App.Http.Data.InputData;
  render: (element: {
    error: string | undefined;
    value: unknown;
    onFieldChange: (value: unknown) => void;
  }) => ReactNode;
};

function FormField({ conditions, element, handle, render }: FormFieldProps) {
  const { data, errors, setData } = useForm();

  const [visible, setVisible] = useState<boolean>(true);

  function getError() {
    return get(errors, handle);
  }

  function getValue() {
    const defaultValue = (element.settings as Record<string, unknown>)?.value ?? "";

    return get(data, handle, defaultValue);
  }

  useEffect(() => {
    if (get(data, handle) === undefined) {
      setData?.(handle, getValue());
    }
  }, []);

  useEffect(() => {
    let nextVisible = true;

    for (const condition of conditions || []) {
      if (get(data, replaceLastPath(handle, condition.handle)) !== condition.value) {
        nextVisible = false;
        break;
      }
    }

    if (nextVisible && !visible) {
      setVisible(true);
    } else if (!nextVisible && visible) {
      setData?.((data: Record<string, unknown>) => {
        const newData = cloneDeep(data);

        unset(newData, handle);

        return newData;
      });

      setVisible(false);
    }
  }, [data]);

  const contextValue = {
    error: getError(),
    handle: handle,
  };

  return visible ? (
    <FormFieldContext.Provider value={contextValue}>
      {render({
        error: getError(),
        value: getValue(),

        onFieldChange: (value) => {
          setData?.(handle, value);
        },
      })}
    </FormFieldContext.Provider>
  ) : null;
}

export default FormField;
