import { Container } from "@/blocks/container";
import { ComponentProps } from "react";

export type LayoutProps = {
  size: ComponentProps<typeof Container>["variant"];
  padding: {
    bottom: ComponentProps<typeof Container>["paddingBottom"];
    top: ComponentProps<typeof Container>["paddingTop"];
  };
};
