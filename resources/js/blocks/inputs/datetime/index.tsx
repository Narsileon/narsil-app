import { InputContent, InputRoot } from "@/components/input";
import { cn } from "@narsil-cms/lib/utils";
import { type ComponentProps } from "react";

type DatetimeProps = ComponentProps<typeof InputContent>;

function DateTime({ className, ...props }: DatetimeProps) {
  return (
    <InputRoot>
      <InputContent
        className={cn("", className)}
        {...props}
        name={props.id}
        type="datetime-local"
      />
    </InputRoot>
  );
}

export default DateTime;
