import { InputContent, InputRoot } from "@/components/input";
import { cn } from "@narsil-cms/lib/utils";
import { type ComponentProps } from "react";

type InputDateProps = ComponentProps<typeof InputContent>;

function InputDate({ className, ...props }: InputDateProps) {
  return (
    <InputRoot>
      <InputContent className={cn("", className)} {...props} type="date" />
    </InputRoot>
  );
}

export default InputDate;
