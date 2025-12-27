import { Link } from "@narsil-cms/blocks";
import { cn } from "@narsil-cms/lib/utils";
import { type ComponentProps } from "react";

type HeaderProps = ComponentProps<"header">;

function Header({ className, ...props }: HeaderProps) {
  return (
    <header
      className={cn(
        "sticky top-0 right-0 left-0 z-10 flex w-full items-center justify-between bg-background py-2 pr-2 pl-4 text-foreground md:px-4 md:py-4 lg:px-14 xl:px-20",
        className,
      )}
      {...props}
    >
      <Link className="text-lg font-bold" href="/">
        NARSIL
      </Link>
      <nav className="flex gap-8 font-bold">
        <a className="text-gray-800 hover:text-gray-950" href="/narsil/dashboard" target="_blank">
          admin
        </a>
      </nav>
    </header>
  );
}

export default Header;
