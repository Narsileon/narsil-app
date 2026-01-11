declare namespace App.Http.Data {
  export type FieldsetData = {
    handle: string;
    label: string;
    elements: Array<App.Http.Data.FormElementData>;
  };
  export type FooterData = {
    address_line_1: string | null;
    address_line_2: string | null;
    company: string | null;
    copyright: string | null;
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
  export type FormData = {
    id: number;
    slug: string;
    tabs: Array<App.Http.Data.FormTabData>;
  };
  export type FormElementConditionData = {
    handle: string;
    operator: string;
    value: string;
  };
  export type FormElementData = {
    base: App.Http.Data.FieldsetData | App.Http.Data.InputData;
    conditions: Array<App.Http.Data.FormElementConditionData>;
    description: string;
    handle: string;
    label: string;
    position: number;
    required: boolean;
    width: number;
  };
  export type FormTabData = {
    description: string;
    handle: string;
    label: string;
    position: number;
    elements: Array<App.Http.Data.FormElementData>;
  };
  export type HeaderData = {};
  export type InputData = {
    description: string;
    handle: string;
    label: string;
    placeholder: string;
    settings: object;
    type: string;
    options: Array<App.Http.Data.InputOptionData>;
  };
  export type InputOptionData = {
    label: string;
    value: string;
  };
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
