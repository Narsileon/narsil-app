declare namespace App.Http.Data {
  export type FooterData = {
    address_line_1: string | null;
    address_line_2: string | null;
    company: string | null;
    email: string | null;
    logo: string | null;
    phone: string | null;
    links: Array<App.Http.Data.FooterLinkData>;
    social_media: Array<App.Http.Data.FooterSocialMediumData>;
  };
  export type FooterLinkData = {
    label: string;
    url: string;
  };
  export type FooterSocialMediumData = {
    icon: string;
    label: string;
    url: string;
  };
  export type HeaderData = {};
  export type NavigationMenuItemData = {
    id: number;
    title: string;
    url: string;
    children: Array<App.Http.Data.NavigationMenuItemData>;
  };
  export type SitePageData = {
    id: number;
    slug: string;
    title: string;
    data: Array<any>;
    meta_description: string | null;
    open_graph_description: string | null;
    open_graph_image: string | null;
    open_graph_title: string | null;
    open_graph_type: string | null;
    robots: string;
    change_freq: string;
    priority: number;
    urls: Array<App.Http.Data.SiteUrlData>;
  };
  export type SiteUrlData = {
    display_language: string;
    language: string;
    url: string;
  };
}
