import { Icon } from "@/blocks";
import { ButtonRoot } from "@/components/button";
import { type IconName } from "@/components/icon";
import { Link } from "@inertiajs/react";
import { Slot } from "radix-ui";
import { type ComponentProps } from "react";

type ButtonProps = ComponentProps<typeof ButtonRoot> & {
  icon?: IconName;
  iconProps?: ComponentProps<typeof Icon>;
  label?: string;
  linkProps?: ComponentProps<typeof Link>;
  url?: string;
};

function Button({ children, icon, label, url, ...props }: ButtonProps) {
  const iconName = icon;

  return url ? (
    <ButtonRoot asChild={true} {...props}>
      <Link href={url}>
        {iconName ? <Icon name={iconName} /> : null}
        <Slot.Slottable>{label ?? children}</Slot.Slottable>
      </Link>
    </ButtonRoot>
  ) : (
    <ButtonRoot asChild={false} {...props}>
      {iconName ? <Icon name={iconName} /> : null}
      <Slot.Slottable>{label ?? children}</Slot.Slottable>
    </ButtonRoot>
  );
}

export default Button;
