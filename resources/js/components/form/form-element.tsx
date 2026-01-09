import {
  InputDate,
  InputDatetime,
  InputNumber,
  InputText,
  InputTextarea,
  InputTime,
} from "@/blocks/inputs";
import { cn } from "@narsil-cms/lib/utils";
import { ComponentProps } from "react";
import FormDescription from "./form-description";
import FormField from "./form-field";
import FormItem from "./form-item";
import FormLabel from "./form-label";
import FormMessage from "./form-message";

type FormElementProps = App.Http.Data.FormElementData & {
  className?: string;
};

function FormElement({ className, ...props }: FormElementProps) {
  const { element, width } = props;

  if ("elements" in element) {
    return (
      <fieldset className="col-span-full flex flex-col gap-y-4 rounded-md border p-4">
        <legend className="px-2">{element.label}</legend>
        <div className="lg:gap-x-8gap-y-4 grid grid-cols-12 p-2 sm:gap-x-4">
          {element.elements.map((element) => {
            return <FormElement key={element.handle} {...element} />;
          })}
        </div>
      </fieldset>
    );
  } else {
    return (
      <FormField
        {...props}
        element={element}
        render={({ value, onFieldChange }) => {
          const inputProps = {
            ...(element.settings ?? {}),
            id: props.handle,
            name: props.handle,
            placeholder: element.placeholder,
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
              {props.description ? (
                <FormDescription>{props.description as string}</FormDescription>
              ) : null}
              {element.type === "Narsil\\Contracts\\Fields\\DateField" ? (
                <InputDate
                  {...(inputProps as ComponentProps<typeof InputDate>)}
                  onChange={(event) => onFieldChange(event.target.value)}
                />
              ) : element.type === "Narsil\\Contracts\\Fields\\DateTimeField" ? (
                <InputDatetime
                  {...(inputProps as ComponentProps<typeof InputDatetime>)}
                  onChange={(event) => onFieldChange(event.target.value)}
                />
              ) : element.type === "Narsil\\Contracts\\Fields\\EmailField" ? (
                <InputText
                  {...(inputProps as ComponentProps<typeof InputText>)}
                  type="email"
                  onChange={(event) => onFieldChange(event.target.value)}
                />
              ) : element.type === "Narsil\\Contracts\\Fields\\NumberField" ? (
                <InputNumber
                  {...(inputProps as ComponentProps<typeof InputNumber>)}
                  onChange={(event) => onFieldChange(event.target.value)}
                />
              ) : element.type === "Narsil\\Contracts\\Fields\\TextareaField" ? (
                <InputTextarea
                  {...(inputProps as ComponentProps<typeof InputTextarea>)}
                  onChange={(event) => onFieldChange(event.target.value)}
                />
              ) : element.type === "Narsil\\Contracts\\Fields\\TimeField" ? (
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
              <FormMessage />
            </FormItem>
          );
        }}
      />
    );
  }
}

export default FormElement;
