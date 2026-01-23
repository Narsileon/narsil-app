import { cn } from "@narsil-cms/lib/utils";
import { type ComponentProps } from "react";

type TextareaRootProps = ComponentProps<"textarea">;

function TextareaRoot({ className, ...props }: TextareaRootProps) {
  return (
    <textarea
      data-slot="textarea-root"
      className={cn(
        "flex field-sizing-content min-h-16 w-full rounded-md border bg-input px-3 py-2 shadow-sm outline-none",
        "transition-[color] duration-300",
        "aria-invalid:border-destructive aria-invalid:ring-destructive/20",
        "disabled:cursor-not-allowed disabled:opacity-50",
        "focus-within:border-secondary focus-visible:border-secondary",
        "placeholder:text-muted-foreground",
        className,
      )}
      {...props}
    />
  );
}

export default TextareaRoot;
