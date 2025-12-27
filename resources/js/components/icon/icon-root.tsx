import { cn } from "@narsil-cms/lib/utils";
import { startCase } from "lodash-es";
import { type ComponentProps } from "react";
import { type IconName, icons } from "./icon-registry";

type IconRootProps = ComponentProps<"svg"> & {
  name: IconName;
};

function IconRoot({ className, name, ...props }: IconRootProps) {
  const Comp = icons[name] ?? icons["default"];

  return (
    <Comp
      data-slot="icon-root"
      className={cn("size-6 text-primary", className)}
      aria-label={startCase(name)}
      {...props}
    />
  );
}

export default IconRoot;
