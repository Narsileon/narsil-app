import { Label } from "@narsil-cms/components/label";
import { useLocalization } from "@narsil-cms/components/localization";
import { cn } from "@narsil-cms/lib/utils";
import { type ComponentProps } from "react";
import useFormField from "./form-field-context";

function FormLabel({ children, className, ...props }: ComponentProps<typeof Label>) {
  const { error, handle } = useFormField();
  const { trans } = useLocalization();

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
