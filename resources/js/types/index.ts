export type GlobalProps = {
  footer: App.Http.Data.FooterData;
  header: App.Http.Data.HeaderData;
  navigation_menu: App.Http.Data.NavigationMenuItemData[];
  page: App.Http.Data.SitePageData;
  session: {
    locale: string;
  };
};
