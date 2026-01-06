import { InputContent, InputRoot } from "@/components/input";
import { cn } from "@narsil-cms/lib/utils";
import { type ComponentProps } from "react";

type InputNumberProps = ComponentProps<typeof InputContent>;

function InputNumber({ className, ...props }: InputNumberProps) {
  return (
    <InputRoot>
      <InputContent className={cn("", className)} {...props} type="number" />
    </InputRoot>
  );
}

export default InputNumber;
