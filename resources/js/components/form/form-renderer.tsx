import { cn } from "@narsil-cms/lib/utils";
import { getField } from "@narsil-cms/repositories/fields";
import type { Condition, Fieldset, FormTab, Input } from "@narsil-cms/types";
import { Fragment } from "react";
import FormDescription from "./form-description";
import FormField from "./form-field";
import FormItem from "./form-item";
import FormLabel from "./form-label";
import FormMessage from "./form-message";

type FormRendererProps = (Fieldset | FormTab | Input) & {
  className?: string;
  conditions?: Condition[];
  required?: boolean;
  translatable?: boolean;
  width?: number;
  onChange?: (value: unknown) => void;
};

function FormRenderer({ className, conditions, width, onChange, ...props }: FormRendererProps) {
  if ("elements" in props) {
    return (
      <>
        {props.elements?.map((element, index) => {
          const childElement = element.element;

          return (
            <Fragment key={index}>
              {"type" in childElement ? (
                <FormRenderer
                  {...childElement}
                  conditions={element.conditions}
                  handle={element.handle ?? childElement.handle}
                  name={element.name ?? childElement.name}
                  required={element.required ?? childElement.required}
                  translatable={element.translatable ?? childElement.translatable}
                  width={element.width}
                />
              ) : (
                <fieldset>
                  <FormRenderer
                    {...childElement}
                    handle={element.handle ?? childElement.handle}
                    name={element.name ?? childElement.name}
                    width={element.width}
                  />
                </fieldset>
              )}
            </Fragment>
          );
        })}
      </>
    );
  }

  if (!("settings" in props)) {
    return null;
  }

  const { description, required, settings, type } = props as {
    description?: string;
    required?: boolean;
    translatable?: boolean;
    type: Input["type"];
    settings: {
      append?: string;
      className?: string;
      generate?: string;
      type?: string;
    };
  };

  return (
    <FormField
      id={props.handle}
      conditions={conditions}
      input={props as Input}
      render={({ value, onFieldChange }) => {
        function handleOnChange(value: unknown) {
          onChange?.(value);
          onFieldChange(value);
        }

        return (
          <FormItem
            className={cn(
              settings.type === "hidden" && "hidden",
              props.class_name ?? "",
              className,
            )}
            width={width}
          >
            <div className="flex items-center justify-between gap-3">
              <div className="flex items-center gap-1">
                <FormLabel required={required}>{props.name}</FormLabel>
              </div>
            </div>
            {getField(type, {
              id: props.handle,
              element: props as Input,
              placeholder: props.placeholder as string,
              required: required,
              value: value,
              setValue: handleOnChange,
            })}
            {props.description ? <FormDescription>{description}</FormDescription> : null}
            <FormMessage />
          </FormItem>
        );
      }}
    />
  );
}

export default FormRenderer;
