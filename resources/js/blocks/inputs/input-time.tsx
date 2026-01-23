import { InputContent, InputRoot } from "@/components/input";
import { cn } from "@narsil-cms/lib/utils";
import { type ComponentProps } from "react";

type InputTimeProps = ComponentProps<typeof InputContent>;

function InputTime({ className, ...props }: InputTimeProps) {
  return (
    <InputRoot>
      <InputContent className={cn("", className)} {...props} type="time" />
    </InputRoot>
  );
}

export default InputTime;
