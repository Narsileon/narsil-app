import { Button } from "@/blocks/button";
import { Container } from "@/blocks/container";
import { LayoutProps } from "@/types";
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
      <Button {...props} />
    </Container>
  );
}

export default CallToAction;
