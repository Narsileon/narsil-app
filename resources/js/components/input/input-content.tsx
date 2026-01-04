import { cn } from "@narsil-cms/lib/utils";
import { type ComponentProps } from "react";

type InputContentProps = ComponentProps<"input">;

function InputContent({ className, ...props }: InputContentProps) {
  return (
    <input
      data-slot="input-content"
      className={cn(
        "h-full min-w-0 grow bg-transparent py-1 outline-none",
        "placeholder:text-muted-foreground",
        "selection:bg-primary selection:text-primary-foreground",
        className,
      )}
      {...props}
    />
  );
}

export default InputContent;
