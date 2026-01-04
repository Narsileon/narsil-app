import { Fieldset, FormTab, Input } from "@narsil-cms/types";

export type FormType = {
  action: string;
  description: string;
  id: string;
  submitLabel: string;
  tabs: (Fieldset | FormTab | Input)[];
  title: string;
};

export type GlobalProps = {
  footer: App.Http.Data.FooterData;
  header: App.Http.Data.HeaderData;
  navigation_menu: App.Http.Data.NavigationMenuItemData[];
  page: App.Http.Data.SitePageData;
  session: {
    locale: string;
  };
};
