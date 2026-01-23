import { cn } from "@narsil-cms/lib/utils";
import { NavigationMenu } from "radix-ui";
import { type ComponentProps } from "react";

type NavigationMenuItemProps = ComponentProps<typeof NavigationMenu.Item>;

function NavigationMenuItem({ className, ...props }: NavigationMenuItemProps) {
  return (
    <NavigationMenu.Item
      data-slot="navigation-menu-item"
      className={cn(
        "relative bg-linear-to-r from-transparent to-transparent transition-colors duration-300 hover:text-primary",
        className,
      )}
      {...props}
    />
  );
}

export default NavigationMenuItem;
