import { useForm } from "@inertiajs/react";
import { set } from "lodash-es";
import { FormContext, type FormContextProps } from "./form-context";

type FormProviderProps = {
  action: string;
  id: string;
  initialValues?: Record<string, unknown>;
  steps?: App.Http.Data.FormStepData[];
  render: (props: FormContextProps) => React.ReactNode;
};

function FormProvider({ action, initialValues = {}, steps = [], id, render }: FormProviderProps) {
  function flattenValues(
    bases: (App.Http.Data.FieldsetData | App.Http.Data.FormStepData | App.Http.Data.InputData)[],
  ): Record<string, unknown> {
    const receivedValues: Record<string, unknown> = {};

    bases.map((base) => {
      if ("elements" in base) {
        base.elements?.map((element) => {
          const child = element.base;

          if ("elements" in child) {
            Object.assign(receivedValues, flattenValues([child]));
          } else if ("type" in child) {
            set(
              receivedValues,
              element.handle,
              (child.settings as Record<string, unknown>)?.value ?? "",
            );
          }
        });
      } else if ("type" in base) {
        set(receivedValues, base.handle, (base.settings as Record<string, unknown>)?.value ?? "");
      }
    });

    return receivedValues;
  }

  const mergedInitialValues = Object.assign(flattenValues(steps), initialValues);

  const {
    data,
    errors,
    isDirty,
    processing,
    cancel,
    clearErrors,
    patch,
    post,
    put,
    reset,
    setData,
    setDefaults,
    setError,
    submit,
    transform,
  } = useForm<Record<string, any>>(mergedInitialValues);

  const contextValue = {
    action: action,
    data: data,
    errors: errors,
    id: id,
    isDirty: isDirty,
    processing: processing,
    cancel: cancel,
    clearErrors: clearErrors,
    patch: patch,
    post: post,
    put: put,
    reset: reset,
    setData: setData,
    setDefaults: setDefaults,
    setError: setError,
    submit: submit,
    transform: transform,
  };

  return <FormContext.Provider value={contextValue}>{render(contextValue)}</FormContext.Provider>;
}

export default FormProvider;
