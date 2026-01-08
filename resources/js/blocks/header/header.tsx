import {
  NavigationMenuItem,
  NavigationMenuList,
  NavigationMenuRoot,
} from "@/components/navigation-menu";
import { useGlobal } from "@/providers/global";
import type { GlobalProps } from "@/types";
import { Link } from "@inertiajs/react";
import { cn } from "@narsil-cms/lib/utils";
import { useEffect, useRef, type ComponentProps } from "react";

type HeaderProps = ComponentProps<"header"> & Pick<GlobalProps, "navigation_menu">;

function Header({ className, navigation_menu, ...props }: HeaderProps) {
  const { setHeaderHeight } = useGlobal();

  const ref = useRef<HTMLDivElement>(null);

  useEffect(() => {
    const updateHeight = () => {
      if (ref.current) {
        setHeaderHeight(ref.current.offsetHeight);
      }
    };

    updateHeight();

    window.addEventListener("resize", updateHeight);

    return () => window.removeEventListener("resize", updateHeight);
  }, [setHeaderHeight]);

  return (
    <header
      ref={ref}
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
            const active = window.location.href.includes(url);

            return (
              <NavigationMenuItem
                className={cn("leading-6 md:leading-normal", active && "text-primary")}
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
