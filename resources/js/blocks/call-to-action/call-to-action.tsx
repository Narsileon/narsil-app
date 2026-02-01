import { Button } from "@/blocks/button";
import { LayoutProps } from "@/types";
import { Container } from "@narsil-cms/components/container";
import { type ComponentProps } from "react";

type CallToActionProps = ComponentProps<typeof Button> & {
  layout: LayoutProps;
};

function CallToAction({ layout, ...props }: CallToActionProps) {
  return (
    <Container
      paddingBottom={layout.padding.bottom}
      paddingTop={layout.padding.top}
      variant={layout.size}
    >
      <Button
        className="transition-transform duration-200 will-change-transform hover:scale-105"
        size="lg"
        {...props}
      />
    </Container>
  );
}

export default CallToAction;
