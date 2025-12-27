import { IconRoot } from "@/components/icon";
import { type ComponentProps } from "react";

type IconProps = ComponentProps<typeof IconRoot>;

function Icon({ ...props }: IconProps) {
  return <IconRoot {...props} />;
}

export default Icon;
