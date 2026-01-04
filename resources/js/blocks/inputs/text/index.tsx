import { InputContent, InputRoot } from "@/components/input";
import { cn } from "@narsil-cms/lib/utils";
import { type ComponentProps } from "react";

type TextProps = ComponentProps<typeof InputContent>;

function Text({ className, ...props }: TextProps) {
  return (
    <InputRoot>
      <InputContent className={cn("", className)} {...props} />
    </InputRoot>
  );
}

export default Text;
