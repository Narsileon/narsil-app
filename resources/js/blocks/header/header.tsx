import { useGlobal } from "@/providers/global";
import { Link } from "@inertiajs/react";
import {
  NavigationMenuItem,
  NavigationMenuLink,
  NavigationMenuList,
  NavigationMenuRoot,
} from "@narsil-ui/components/navigation-menu";
import { cn } from "@narsil-ui/lib/utils";
import { useEffect, useRef, type ComponentProps } from "react";

type HeaderProps = ComponentProps<"header"> & Pick<App.Http.Data.GlobalData, "navigation">;

function Header({ className, navigation, ...props }: HeaderProps) {
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
        "sticky top-0 right-0 left-0 z-10 flex w-full items-center justify-between bg-layout px-4 py-2 text-layout-foreground md:px-4 md:py-4 lg:px-14 xl:px-20",
        className,
      )}
      {...props}
    >
      <Link className="text-lg font-bold" href="/">
        NARSIL
      </Link>
      <NavigationMenuRoot aria-label="Header Menu">
        <NavigationMenuList className="gap-4 font-bold lg:gap-8">
          {navigation[0].children.map(({ title, url }, index) => {
            const active = window.location.href.includes(url);

            return (
              <NavigationMenuItem key={index}>
                <NavigationMenuLink
                  {...(active ? { "data-active": true } : {})}
                  render={<Link href={url}>{title}</Link>}
                />
              </NavigationMenuItem>
            );
          })}
        </NavigationMenuList>
      </NavigationMenuRoot>
    </header>
  );
}

export default Header;
