import { Label } from "@narsil-ui/components/label";
import { useTranslator } from "@narsil-ui/components/translator";
import { cn } from "@narsil-ui/lib/utils";
import { type ComponentProps } from "react";
import useFormField from "./form-field-context";

function FormLabel({ children, className, ...props }: ComponentProps<typeof Label>) {
  const { error, handle } = useFormField();
  const { trans } = useTranslator();

  return (
    <Label
      data-error={!!error}
      data-slot="form-label"
      className={cn("min-h-7 items-center data-[error=true]:text-destructive", className)}
      htmlFor={handle}
      requiredLabel={trans("ui.required")}
      {...props}
    >
      <span className="first-letter:uppercase">{children}</span>
    </Label>
  );
}

export default FormLabel;
