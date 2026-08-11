import { Button } from "@/blocks/button";
import { LayoutProps } from "@/types";
import { nodeAttributes } from "@narsil-cms/live-editor/core/preview-bridge";
import { Container } from "@narsil-ui/components/container";
import { type ComponentProps } from "react";

type CallToActionProps = ComponentProps<typeof Button> & {
  layout: LayoutProps;
  nodeId?: string;
};

function CallToAction({ layout, nodeId, ...props }: CallToActionProps) {
  return (
    <Container
      paddingBottom={layout.padding.bottom}
      paddingTop={layout.padding.top}
      variant={layout.size}
      {...nodeAttributes(nodeId)}
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
