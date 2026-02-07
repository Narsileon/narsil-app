import { FieldDescription, FieldError, FieldLabel, FieldRoot } from "@narsil-ui/components/field";
import { FieldsetLegend, FieldSetRoot } from "@narsil-ui/components/fieldset";
import { Input } from "@narsil-ui/components/input";
import { Textarea } from "@narsil-ui/components/textarea";
import { cn } from "@narsil-ui/lib/utils";
import { ComponentProps } from "react";
import FormField from "./form-field";

type FormElementProps = App.Http.Data.FormElementData & {
  className?: string;
};

function FormElement({ className, ...props }: FormElementProps) {
  const { base, handle, width } = props;

  if ("elements" in base) {
    return (
      <FieldSetRoot className="col-span-full">
        <FieldsetLegend>{base.label}</FieldsetLegend>
        <div className="grid grid-cols-12 gap-y-4 sm:gap-x-4 lg:gap-x-8">
          {base.elements.map((element) => {
            return (
              <FormElement
                {...element}
                handle={`${handle}.${element.handle}`}
                key={element.handle}
              />
            );
          })}
        </div>
      </FieldSetRoot>
    );
  } else {
    return (
      <FormField
        {...props}
        element={base}
        render={({ error, value, onFieldChange }) => {
          const inputProps = {
            ...(base.settings ?? {}),
            id: props.handle,
            name: props.handle,
            placeholder: base.placeholder,
            required: props.required,
            value: value,
          };

          return (
            <FieldRoot className={cn("", className)} width={width}>
              <div className="flex items-center justify-between gap-3">
                <div className="flex items-center gap-1">
                  <FieldLabel required={props.required}>{props.label}</FieldLabel>
                </div>
              </div>
              {props.description ? (
                <FieldDescription>{props.description as string}</FieldDescription>
              ) : null}
              {base.type === "Narsil\\Cms\\Contracts\\Fields\\DateField" ? (
                <Input
                  {...(inputProps as ComponentProps<typeof Input>)}
                  type="date"
                  onChange={(event) => onFieldChange(event.target.value)}
                />
              ) : base.type === "Narsil\\Cms\\Contracts\\Fields\\DateTimeField" ? (
                <Input
                  {...(inputProps as ComponentProps<typeof Input>)}
                  type="datetime-local"
                  onChange={(event) => onFieldChange(event.target.value)}
                />
              ) : base.type === "Narsil\\Cms\\Contracts\\Fields\\EmailField" ? (
                <Input
                  {...(inputProps as ComponentProps<typeof Input>)}
                  type="email"
                  onChange={(event) => onFieldChange(event.target.value)}
                />
              ) : base.type === "Narsil\\Cms\\Contracts\\Fields\\NumberField" ? (
                <Input
                  {...(inputProps as ComponentProps<typeof Input>)}
                  type="number"
                  onChange={(event) => onFieldChange(event.target.value)}
                />
              ) : base.type === "Narsil\\Cms\\Contracts\\Fields\\TextareaField" ? (
                <Textarea
                  {...(inputProps as ComponentProps<typeof Textarea>)}
                  onChange={(event) => onFieldChange(event.target.value)}
                />
              ) : base.type === "Narsil\\Cms\\Contracts\\Fields\\TimeField" ? (
                <Input
                  {...(inputProps as ComponentProps<typeof Input>)}
                  type="time"
                  onChange={(event) => onFieldChange(event.target.value)}
                />
              ) : (
                <Input
                  {...(inputProps as ComponentProps<typeof Input>)}
                  type="text"
                  onChange={(event) => onFieldChange(event.target.value)}
                />
              )}
              <FieldError>{error}</FieldError>
            </FieldRoot>
          );
        }}
      />
    );
  }
}

export default FormElement;
