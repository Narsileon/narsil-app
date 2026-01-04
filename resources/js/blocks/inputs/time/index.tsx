import { InputContent, InputRoot } from "@/components/input";
import { cn } from "@narsil-cms/lib/utils";
import { type ComponentProps } from "react";

type TimeProps = ComponentProps<typeof InputContent>;

function Time({ className, ...props }: TimeProps) {
  return (
    <InputRoot>
      <InputContent className={cn("", className)} {...props} name={props.id} type="date" />
    </InputRoot>
  );
}

export default Time;
