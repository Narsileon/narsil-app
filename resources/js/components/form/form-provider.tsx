import { useForm } from "@inertiajs/react";
import type { Fieldset, FormTab, Input } from "@narsil-cms/types";
import { set } from "lodash-es";
import { FormContext, type FormContextProps } from "./form-context";

type FormProviderProps = {
  action: string;
  elements?: (Fieldset | FormTab | Input)[];
  id: string;
  render: (props: FormContextProps) => React.ReactNode;
};

function FormProvider({ action, elements = [], id, render }: FormProviderProps) {
  function flattenValues(elements: (Fieldset | FormTab | Input)[]): Record<string, unknown> {
    const receivedValues: Record<string, unknown> = {};

    elements.map((element) => {
      if ("elements" in element) {
        element.elements?.map((hasElement) => {
          const childElement = hasElement.element;

          if ("elements" in childElement) {
            Object.assign(receivedValues, flattenValues([childElement]));
          } else if ("type" in childElement) {
            set(
              receivedValues,
              hasElement.handle,
              (childElement.settings as Record<string, unknown>)?.value ?? "",
            );
          }
        });
      } else if ("type" in element) {
        set(
          receivedValues,
          element.handle,
          (element.settings as Record<string, unknown>)?.value ?? "",
        );
      }
    });

    return receivedValues;
  }

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
  } = useForm<Record<string, any>>(Object.assign(flattenValues(elements)));

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
