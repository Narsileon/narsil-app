import {
  InputDate,
  InputDatetime,
  InputNumber,
  InputText,
  InputTextarea,
  InputTime,
} from "@/blocks/inputs";

import { cn } from "@narsil-cms/lib/utils";
import { ComponentProps, Fragment } from "react";
import FormDescription from "./form-description";
import FormField from "./form-field";
import FormItem from "./form-item";
import FormLabel from "./form-label";
import FormMessage from "./form-message";

type FormRendererProps = (
  | App.Http.Data.FieldsetData
  | App.Http.Data.FormTabData
  | App.Http.Data.InputData
) & {
  className?: string;
  conditions?: App.Http.Data.FormElementConditionData[];
  required?: boolean;
  width?: number;
};

function FormRenderer({ className, conditions, width, ...props }: FormRendererProps) {
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
                  label={element.label ?? childElement.label}
                  required={element.required}
                  width={element.width}
                />
              ) : (
                <fieldset className="col-span-full flex flex-col gap-x-8 gap-y-4 rounded-md border p-4">
                  <legend className="px-2">{element.label}</legend>
                  <div className="p-2">
                    <FormRenderer
                      {...childElement}
                      handle={element.handle ?? childElement.handle}
                      label={element.label ?? childElement.label}
                      width={element.width}
                    />
                  </div>
                </fieldset>
              )}
            </Fragment>
          );
        })}
      </>
    );
  }

  return (
    <FormField
      id={props.handle}
      conditions={conditions}
      input={props as App.Http.Data.InputData}
      render={({ value, onFieldChange }) => {
        const inputProps = {
          ...(props.settings ?? {}),
          id: props.handle,
          name: props.handle,
          required: props.required,
          value: value,
        };

        return (
          <FormItem className={cn("", className)} width={width}>
            <div className="flex items-center justify-between gap-3">
              <div className="flex items-center gap-1">
                <FormLabel required={props.required}>{props.label}</FormLabel>
              </div>
            </div>
            {props.type === "Narsil\\Contracts\\Fields\\DateField" ? (
              <InputDate
                {...(inputProps as ComponentProps<typeof InputDate>)}
                onChange={(event) => onFieldChange(event.target.value)}
              />
            ) : props.type === "Narsil\\Contracts\\Fields\\DateTimeField" ? (
              <InputDatetime
                {...(inputProps as ComponentProps<typeof InputDatetime>)}
                onChange={(event) => onFieldChange(event.target.value)}
              />
            ) : props.type === "Narsil\\Contracts\\Fields\\EmailField" ? (
              <InputText
                {...(inputProps as ComponentProps<typeof InputText>)}
                type="email"
                onChange={(event) => onFieldChange(event.target.value)}
              />
            ) : props.type === "Narsil\\Contracts\\Fields\\NumberField" ? (
              <InputNumber
                {...(inputProps as ComponentProps<typeof InputNumber>)}
                onChange={(event) => onFieldChange(event.target.value)}
              />
            ) : props.type === "Narsil\\Contracts\\Fields\\TextareaField" ? (
              <InputTextarea
                {...(inputProps as ComponentProps<typeof InputTextarea>)}
                onChange={(event) => onFieldChange(event.target.value)}
              />
            ) : props.type === "Narsil\\Contracts\\Fields\\TimeField" ? (
              <InputTime
                {...(inputProps as ComponentProps<typeof InputTime>)}
                onChange={(event) => onFieldChange(event.target.value)}
              />
            ) : (
              <InputText
                {...(inputProps as ComponentProps<typeof InputText>)}
                onChange={(event) => onFieldChange(event.target.value)}
              />
            )}
            {props.description ? (
              <FormDescription>{props.description as string}</FormDescription>
            ) : null}
            <FormMessage />
          </FormItem>
        );
      }}
    />
  );
}

export default FormRenderer;
