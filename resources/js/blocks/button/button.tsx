import { Link } from "@inertiajs/react";
import { nodeAttributes } from "@narsil-cms/live-editor/core/preview-bridge";
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
  nodeId?: string;
};

function Button({ children, icon, label, link, nodeId, ...props }: ButtonProps) {
  const iconName = icon;

  const attributes = nodeAttributes(nodeId);

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
        {...attributes}
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
        {...attributes}
        {...props}
      />
    )
  ) : (
    <ButtonPrimitive {...attributes} {...props}>
      {iconName ? <Icon name={iconName} /> : null}
      {label ?? children}
    </ButtonPrimitive>
  );
}

export default Button;
