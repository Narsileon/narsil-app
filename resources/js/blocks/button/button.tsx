import { Icon } from "@/blocks/icon";
import { ButtonRoot } from "@/components/button";
import { type IconName } from "@/components/icon";
import { Link } from "@inertiajs/react";
import { Slot } from "radix-ui";
import { type ComponentProps } from "react";

type ButtonProps = ComponentProps<typeof ButtonRoot> & {
  icon?: IconName;
  label?: string;
  link?: {
    type: "internal" | "external";
    url: string;
  };
};

function Button({ asChild = false, children, icon, label, link, ...props }: ButtonProps) {
  const iconName = icon;

  return link ? (
    link.type === "external" ? (
      <ButtonRoot asChild={true} {...props}>
        <a href={link.url} target="_blank">
          {iconName ? <Icon name={iconName} /> : null}
          <Slot.Slottable>{label ?? children}</Slot.Slottable>
        </a>
      </ButtonRoot>
    ) : (
      <ButtonRoot asChild={true} {...props}>
        <Link href={link.url}>
          {iconName ? <Icon name={iconName} /> : null}
          <Slot.Slottable>{label ?? children}</Slot.Slottable>
        </Link>
      </ButtonRoot>
    )
  ) : (
    <ButtonRoot asChild={asChild} {...props}>
      {iconName ? <Icon name={iconName} /> : null}
      <Slot.Slottable>{label ?? children}</Slot.Slottable>
    </ButtonRoot>
  );
}

export default Button;
