import { useGlobal } from "@/providers/global";
import { cn } from "@narsil-ui/lib/utils";
import { type ComponentProps } from "react";

type HeaderProps = ComponentProps<"main">;

function Main({ className, style, ...props }: HeaderProps) {
  const { headerHeight } = useGlobal();

  return (
    <main
      className={cn(
        "flex h-fit min-h-svh flex-col items-center justify-center bg-background text-foreground",
        className,
      )}
      style={{
        ...style,
        minHeight: `calc(100vh - ${headerHeight}px)`,
      }}
      {...props}
    />
  );
}

export default Main;
