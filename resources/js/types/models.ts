export type Footer = {
  address_line_1: string;
  address_line_2: string;
  company: string;
  email: string;
  links?: FooterLink[];
  logo: string;
  phone: string;
  social_media?: FooterSocialMedium[];
};

export type FooterSocialMedium = {
  icon: string;
  label: string;
  url: string;
  position: number;
};

export type FooterLink = {
  label: string;
  url: string;
};

export type SitePage = {
  content: {
    blocks: SitePageBlock[];
  };
  meta_description: string;
  open_graph_description: string;
  open_graph_image: string;
  open_graph_title: string;
  open_graph_type: string;
  title: string;
  urls: SiteUrl[];
};

export type SitePageBlock = {
  handle: string;
  [key: string]: unknown;
};

export type SiteUrl = {
  display_language: string;
  language: string;
  url: string;
};
