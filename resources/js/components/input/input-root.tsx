import { cn } from "@narsil-cms/lib/utils";
import { type ComponentProps } from "react";

type InputRootProps = ComponentProps<"div">;

function InputRoot({ className, ...props }: InputRootProps) {
  return (
    <div
      data-slot="input-root"
      className={cn(
        "group/input relative inline-flex h-9 w-full shrink-0 items-center justify-between gap-2 rounded-md border bg-input px-2 shadow-sm",
        "transition-[color] duration-300",
        "aria-disabled:pointer-events-none aria-disabled:cursor-not-allowed aria-disabled:opacity-50",
        "aria-invalid:border-destructive aria-invalid:ring-destructive/20",
        "aria-readonly:pointer-events-none aria-readonly:cursor-not-allowed aria-readonly:opacity-50",
        "focus-within:border-secondary focus-visible:border-secondary",
        className,
      )}
      {...props}
    />
  );
}

export default InputRoot;
