import { cn } from "@narsil-cms/lib/utils";
import { type VariantProps } from "class-variance-authority";
import { Slot } from "radix-ui";
import { type ComponentProps } from "react";
import containerRootVariants from "./container-root-variants";

type ContainerProps = ComponentProps<"div"> &
  VariantProps<typeof containerRootVariants> & { asChild?: boolean };

function ContainerRoot({
  asChild = false,
  className,
  paddingBottom,
  paddingTop,
  variant,
  ...props
}: ContainerProps) {
  const Comp = asChild ? Slot.Root : "div";

  return (
    <Comp
      data-slot="container-root"
      className={cn(
        containerRootVariants({
          className: className,
          paddingBottom: paddingBottom,
          paddingTop: paddingTop,
          variant: variant,
        }),
      )}
      {...props}
    />
  );
}

export default ContainerRoot;
