import { Link } from "@inertiajs/react";
import { Button } from "@narsil-ui/components/button";
import {
  DropdownMenuItem,
  DropdownMenuPopup,
  DropdownMenuPortal,
  DropdownMenuPositioner,
  DropdownMenuRoot,
  DropdownMenuTrigger,
} from "@narsil-ui/components/dropdown-menu";
import { Icon, IconName } from "@narsil-ui/components/icon";
import {
  NavigationMenuItem,
  NavigationMenuLink,
  NavigationMenuList,
  NavigationMenuRoot,
} from "@narsil-ui/components/navigation-menu";
import { cn } from "@narsil-ui/lib/utils";
import { upperCase, upperFirst } from "lodash-es";
import { type ComponentProps, useMemo } from "react";

type FooterProps = ComponentProps<"footer"> &
  Pick<App.Http.Data.GlobalData, "footer" | "page" | "session">;

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
        "mx-auto flex w-full flex-col gap-6 bg-layout p-4 text-layout-foreground md:gap-8 md:px-4 md:pt-6 lg:gap-10 lg:px-14 lg:pt-6 xl:px-20 xl:pt-8",
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
              <p className="font-bold">{footer.organization}</p>
              <p className="flex flex-col gap-0.5">
                <span>{footer?.street}</span>
                <span>{`${footer?.postal_code} ${footer?.city} - ${footer?.country}`}</span>
              </p>
            </div>
            <div className="flex flex-col justify-end">
              <Button
                className="w-fit leading-6 text-slate-900 transition-colors duration-150 hover:text-pink-600 md:leading-normal"
                nativeButton={false}
                size="link"
                variant="link"
                render={<a href={`mailto:${footer.email}`}>{footer.email}</a>}
              />
              <Button
                className="w-fit leading-6 text-slate-900 transition-colors duration-150 hover:text-pink-600 md:leading-normal"
                nativeButton={false}
                size="link"
                variant="link"
                render={<a href={`tel:${footer.phone?.replace(/\s+/g, "")}`}>{footer.phone}</a>}
              />
            </div>
          </div>
        </div>
        <div className="flex flex-row justify-between gap-6 sm:flex-col-reverse md:gap-8 lg:gap-10">
          <div className="flex justify-end gap-6">
            {footer.social_media?.map(({ icon, url }, index) => {
              return (
                <Button
                  nativeButton={false}
                  size="icon"
                  variant="ghost"
                  key={index}
                  render={
                    <a href={url} target="_blank">
                      <Icon className="size-6" name={icon as IconName} />
                    </a>
                  }
                />
              );
            })}
          </div>
          <DropdownMenuRoot>
            <DropdownMenuTrigger
              className="group"
              render={
                <Button variant="ghost">
                  <Icon name="globe" />
                  <span className="font-bold">{upperFirst(siteUrl?.display_language)}</span>
                  <span className="-ml-1">{`(${upperCase(siteUrl?.language)})`}</span>
                  <Icon
                    className={cn(
                      "-ml-1 size-4 text-slate-700 duration-300",
                      "group-data-[state=open]:rotate-180",
                    )}
                    name="chevron-down"
                  />
                </Button>
              }
            />
            <DropdownMenuPortal>
              <DropdownMenuPositioner>
                <DropdownMenuPopup>
                  {page?.urls?.map((url, index) => {
                    return (
                      <DropdownMenuItem
                        key={index}
                        render={
                          <Link href={url.url} preserveScroll={true} preserveState={true}>
                            {url.display_language}
                          </Link>
                        }
                      />
                    );
                  })}
                </DropdownMenuPopup>
              </DropdownMenuPositioner>
            </DropdownMenuPortal>
          </DropdownMenuRoot>
        </div>
      </div>
      <div className="flex flex-col flex-wrap items-center gap-2 border-t border-slate-200 pt-4 text-sm text-slate-700 md:flex-row md:justify-between lg:gap-x-8">
        <div>{`©${new Date().getFullYear()} ${footer.organization}. ${footer.copyright}`}</div>
        <NavigationMenuRoot
          className="flex-none grow-0 justify-center md:justify-start"
          aria-label="Footer Menu"
        >
          <NavigationMenuList className="gap-4 text-sm">
            {footer.links?.map(({ label, url }, index) => {
              return (
                <NavigationMenuItem className="leading-6 md:leading-normal" key={index}>
                  <NavigationMenuLink>
                    <Link href={url}>{label}</Link>
                  </NavigationMenuLink>
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
