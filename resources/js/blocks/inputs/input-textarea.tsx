import { TextareaRoot } from "@/components/textarea";
import { cn } from "@narsil-cms/lib/utils";
import { type ComponentProps } from "react";

type InputTextareaProps = ComponentProps<typeof TextareaRoot>;

function InputTextarea({ className, ...props }: InputTextareaProps) {
  return <TextareaRoot className={cn("", className)} {...props} />;
}

export default InputTextarea;
