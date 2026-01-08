import { Label } from "@/blocks/label";
import { cn } from "@narsil-cms/lib/utils";
import { type ComponentProps } from "react";
import { LabelRequired } from "../label";
import useFormField from "./form-field-context";

type FormLabelProps = ComponentProps<typeof Label> & {
  required?: boolean;
};

function FormLabel({ children, className, required = false, ...props }: FormLabelProps) {
  const { error, handle } = useFormField();

  return (
    <Label
      data-slot="form-label"
      data-error={!!error}
      className={cn("data-[error=true]:text-destructive min-h-7 items-center", className)}
      htmlFor={handle}
      {...props}
    >
      <span className="first-letter:uppercase">{children}</span>
      {required && <LabelRequired />}
    </Label>
  );
}

export default FormLabel;
