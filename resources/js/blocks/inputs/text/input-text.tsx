import { InputContent, InputRoot } from "@/components/input";
import { cn } from "@narsil-cms/lib/utils";
import { type ComponentProps } from "react";

type InputTextProps = ComponentProps<typeof InputContent>;

function InputText({ className, ...props }: InputTextProps) {
  return (
    <InputRoot>
      <InputContent className={cn("", className)} {...props} />
    </InputRoot>
  );
}

export default InputText;
