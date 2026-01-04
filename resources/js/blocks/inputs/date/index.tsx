import { InputContent, InputRoot } from "@/components/input";
import { cn } from "@narsil-cms/lib/utils";
import { type ComponentProps } from "react";

type DateProps = ComponentProps<typeof InputContent>;

function Date({ className, ...props }: DateProps) {
  return (
    <InputRoot>
      <InputContent className={cn("", className)} {...props} type="date" />
    </InputRoot>
  );
}

export default Date;
