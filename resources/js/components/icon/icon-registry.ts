import dynamic from "@narsil-cms/lib/dynamic";
import {
  CheckIcon,
  ChevronDownIcon,
  ChevronRightIcon,
  CircleIcon,
  GlobeIcon,
  RabbitIcon,
} from "lucide-react";

export const icons = {
  ["check"]: CheckIcon,
  ["chevron-down"]: ChevronDownIcon,
  ["chevron-right"]: ChevronRightIcon,
  ["circle"]: CircleIcon,
  ["default"]: RabbitIcon,
  ["globe"]: GlobeIcon,
  ["instagram"]: dynamic(() => import("./icon-instagram")),
  ["linkedin"]: dynamic(() => import("./icon-linkedin")),
} as const;

export type IconName = keyof typeof icons;
