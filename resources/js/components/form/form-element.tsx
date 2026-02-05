import { Input } from "@narsil-ui/components/input";
import { Textarea } from "@narsil-ui/components/textarea";
import { cn } from "@narsil-ui/lib/utils";
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
  const { base, handle, width } = props;

  if ("elements" in base) {
    return (
      <fieldset className="col-span-full flex flex-col gap-y-4 rounded-md border p-4">
        <legend className="px-2">{base.label}</legend>
        <div className="lg:gap-x-8gap-y-4 grid grid-cols-12 p-2 sm:gap-x-4">
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
      </fieldset>
    );
  } else {
    return (
      <FormField
        {...props}
        element={base}
        render={({ value, onFieldChange }) => {
          const inputProps = {
            ...(base.settings ?? {}),
            id: props.handle,
            name: props.handle,
            placeholder: base.placeholder,
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
              {base.type === "Narsil\\Contracts\\Fields\\DateField" ? (
                <Input
                  {...(inputProps as ComponentProps<typeof Input>)}
                  type="date"
                  onChange={(event) => onFieldChange(event.target.value)}
                />
              ) : base.type === "Narsil\\Contracts\\Fields\\DateTimeField" ? (
                <Input
                  {...(inputProps as ComponentProps<typeof Input>)}
                  type="datetime-local"
                  onChange={(event) => onFieldChange(event.target.value)}
                />
              ) : base.type === "Narsil\\Contracts\\Fields\\EmailField" ? (
                <Input
                  {...(inputProps as ComponentProps<typeof Input>)}
                  type="email"
                  onChange={(event) => onFieldChange(event.target.value)}
                />
              ) : base.type === "Narsil\\Contracts\\Fields\\NumberField" ? (
                <Input
                  {...(inputProps as ComponentProps<typeof Input>)}
                  type="number"
                  onChange={(event) => onFieldChange(event.target.value)}
                />
              ) : base.type === "Narsil\\Contracts\\Fields\\TextareaField" ? (
                <Textarea
                  {...(inputProps as ComponentProps<typeof Textarea>)}
                  onChange={(event) => onFieldChange(event.target.value)}
                />
              ) : base.type === "Narsil\\Contracts\\Fields\\TimeField" ? (
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
              <FormMessage />
            </FormItem>
          );
        }}
      />
    );
  }
}

export default FormElement;
