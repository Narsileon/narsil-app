import { InputContent, InputRoot } from "@/components/input";
import { cn } from "@narsil-cms/lib/utils";
import { type ComponentProps } from "react";

type InputDatetimeProps = ComponentProps<typeof InputContent>;

function InputDatetime({ className, ...props }: InputDatetimeProps) {
  return (
    <InputRoot>
      <InputContent className={cn("", className)} {...props} type="datetime-local" />
    </InputRoot>
  );
}

export default InputDatetime;
