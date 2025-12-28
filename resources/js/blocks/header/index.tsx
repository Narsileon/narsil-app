import type { GlobalProps } from "@/types";
import { Link } from "@narsil-cms/blocks";
import {
  NavigationMenuItem,
  NavigationMenuList,
  NavigationMenuRoot,
} from "@narsil-cms/components/navigation-menu";
import { cn } from "@narsil-cms/lib/utils";
import { type ComponentProps } from "react";

type HeaderProps = ComponentProps<"header"> & Pick<GlobalProps, "navigation_menu">;

function Header({ className, navigation_menu, ...props }: HeaderProps) {
  return (
    <header
      className={cn(
        "sticky top-0 right-0 left-0 z-10 flex w-full items-center justify-between bg-background px-4 py-2 text-foreground md:px-4 md:py-4 lg:px-14 xl:px-20",
        className,
      )}
      {...props}
    >
      <Link className="text-lg font-bold" href="/">
        NARSIL
      </Link>
      <NavigationMenuRoot className="flex-none grow-0 justify-center md:justify-start">
        <NavigationMenuList className="gap-4 font-bold lg:gap-8">
          {navigation_menu[0].children.map(({ title, url }, index) => {
            return (
              <NavigationMenuItem
                className="leading-6 transition-colors duration-150 hover:text-slate-800 md:leading-normal"
                asChild={true}
                key={index}
              >
                <Link href={url}>{title}</Link>
              </NavigationMenuItem>
            );
          })}
        </NavigationMenuList>
      </NavigationMenuRoot>
    </header>
  );
}

export default Header;
