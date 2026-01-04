import { InputContent, InputRoot } from "@/components/input";
import { cn } from "@narsil-cms/lib/utils";
import { type ComponentProps } from "react";

type NumberProps = ComponentProps<typeof InputContent>;

function Number({ className, ...props }: NumberProps) {
  return (
    <InputRoot>
      <InputContent className={cn("", className)} {...props} name={props.id} type="number" />
    </InputRoot>
  );
}

export default Number;
