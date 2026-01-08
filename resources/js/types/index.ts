import { Container } from "@/blocks/container";
import { ComponentProps } from "react";

export type GlobalProps = {
  footer: App.Http.Data.FooterData;
  header: App.Http.Data.HeaderData;
  navigation_menu: App.Http.Data.NavigationMenuItemData[];
  page: App.Http.Data.SitePageData;
  session: {
    locale: string;
  };
};

export type LayoutProps = {
  size: ComponentProps<typeof Container>["variant"];
  padding: {
    bottom: ComponentProps<typeof Container>["paddingBottom"];
    top: ComponentProps<typeof Container>["paddingTop"];
  };
};
