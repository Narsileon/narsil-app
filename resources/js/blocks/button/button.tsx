import { Link } from "@inertiajs/react";
import { Button as ButtonPrimitive } from "@narsil-ui/components/button";
import { Icon, type IconName } from "@narsil-ui/components/icon";
import { type ComponentProps } from "react";

type ButtonProps = ComponentProps<typeof ButtonPrimitive> & {
  icon?: IconName;
  label?: string;
  link?: {
    type: "internal" | "external";
    url: string;
    page: App.Http.Data.SiteUrlData;
  };
};

function Button({ children, icon, label, link, ...props }: ButtonProps) {
  const iconName = icon;

  return link ? (
    link.type === "external" ? (
      <ButtonPrimitive
        nativeButton={false}
        render={
          <a href={link.url} target="_blank">
            {iconName ? <Icon name={iconName} /> : null}
            {label ?? children}
          </a>
        }
        {...props}
      />
    ) : (
      <ButtonPrimitive
        nativeButton={false}
        render={
          <Link href={link.page.url}>
            {iconName ? <Icon name={iconName} /> : null}
            {label ?? children}
          </Link>
        }
        {...props}
      />
    )
  ) : (
    <ButtonPrimitive {...props}>
      {iconName ? <Icon name={iconName} /> : null}
      {label ?? children}
    </ButtonPrimitive>
  );
}

export default Button;
