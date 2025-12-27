import { Button, Icon } from "@/blocks";
import {
  DropdownMenuContent,
  DropdownMenuRoot,
  DropdownMenuTrigger,
} from "@/components/dropdown-menu";
import { IconName } from "@/components/icon";
import { GlobalProps } from "@/types";
import { Link } from "@narsil-cms/blocks";
import { DropdownMenuItem } from "@narsil-cms/components/dropdown-menu";
import {
  NavigationMenuItem,
  NavigationMenuList,
  NavigationMenuRoot,
} from "@narsil-cms/components/navigation-menu";
import { cn } from "@narsil-cms/lib/utils";
import { upperCase, upperFirst } from "lodash-es";
import { type ComponentProps, useMemo } from "react";

type FooterProps = ComponentProps<"footer"> & Pick<GlobalProps, "footer" | "page" | "session">;

function Footer({ className, footer, page, session, ...props }: FooterProps) {
  const siteUrl = useMemo(
    () =>
      page?.urls?.find((siteUrl) => {
        return siteUrl.language === session.locale;
      }),
    [page, session.locale],
  );

  return (
    <footer
      className={cn(
        "mx-auto flex w-full flex-col gap-6 bg-background p-4 text-slate-950 md:gap-8 md:px-4 md:pt-6 lg:gap-10 lg:px-14 lg:pt-6 xl:px-20 xl:pt-8",
        className,
      )}
      {...props}
    >
      <div className="flex flex-col justify-between gap-6 sm:flex-row">
        <div className="flex flex-col gap-6 md:gap-8 lg:gap-10">
          <div className="flex flex-wrap justify-between gap-6 text-lg font-bold md:items-center md:gap-8 lg:gap-12">
            <a className="text-lg font-bold" href="/">
              NARSIL
            </a>
          </div>
          <div className="flex flex-row gap-10">
            <div className="flex flex-col gap-0.5 lg:gap-2">
              <p className="font-bold">{footer.company}</p>
              <p className="flex flex-col gap-0.5">
                <span>{footer?.address_line_1}</span>
                <span>{footer?.address_line_2}</span>
              </p>
            </div>
            <div className="flex flex-col justify-end">
              <Button
                className="w-fit leading-6 text-slate-900 transition-colors duration-150 hover:text-pink-600 md:leading-normal"
                asChild={true}
                size="link"
                variant="link"
              >
                <a href={`mailto:${footer.email}`}>{footer.email}</a>
              </Button>
              <Button
                className="w-fit leading-6 text-slate-900 transition-colors duration-150 hover:text-pink-600 md:leading-normal"
                asChild={true}
                size="link"
                variant="link"
              >
                <a href={`tel:${footer.phone?.replace(/\s+/g, "")}`}>{footer.phone}</a>
              </Button>
            </div>
          </div>
        </div>
        <div className="flex flex-row justify-between gap-6 sm:flex-col-reverse md:gap-8 lg:gap-10">
          <div className="flex gap-6">
            {footer.social_media?.map(({ icon, url }, index) => {
              return (
                <Button asChild={true} icon={icon as IconName} variant="ghost" key={index}>
                  <a href={url} />
                </Button>
              );
            })}
          </div>
          <DropdownMenuRoot>
            <DropdownMenuTrigger asChild={true}>
              <Button variant="ghost">
                <Icon name="globe" />
                {`${upperFirst(siteUrl?.display_language)} (${upperCase(siteUrl?.language)})`}
              </Button>
            </DropdownMenuTrigger>
            <DropdownMenuContent>
              {page?.urls?.map((url, index) => {
                return (
                  <DropdownMenuItem asChild={true} key={index}>
                    <Link href={url.url}>{url.display_language}</Link>
                  </DropdownMenuItem>
                );
              })}
            </DropdownMenuContent>
          </DropdownMenuRoot>
        </div>
      </div>
      <div className="flex flex-col flex-wrap content-center gap-2 border-t border-slate-200 pt-4 text-sm text-slate-700 md:flex-row md:justify-between lg:gap-x-8">
        <div>{`©${new Date().getFullYear()} ${footer.company}. All rights reserved.`}</div>
        <NavigationMenuRoot className="flex-none grow-0 justify-center md:justify-start">
          <NavigationMenuList className="gap-4 text-sm lg:gap-8">
            {footer.links?.map(({ label, url }, index) => {
              return (
                <NavigationMenuItem
                  className="leading-6 transition-colors duration-150 hover:text-slate-800 md:leading-normal"
                  asChild={true}
                  key={index}
                >
                  <Link href={url}>{label}</Link>
                </NavigationMenuItem>
              );
            })}
          </NavigationMenuList>
        </NavigationMenuRoot>
      </div>
    </footer>
  );
}

export default Footer;
