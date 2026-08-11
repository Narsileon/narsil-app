import { LayoutProps } from "@/types";
import { nodeAttributes } from "@narsil-cms/live-editor/core/preview-bridge";
import {
  AccordionHeader,
  AccordionItem,
  AccordionPanel,
  AccordionRoot,
  AccordionTrigger,
} from "@narsil-ui/components/accordion";
import { Container } from "@narsil-ui/components/container";
import { Heading } from "@narsil-ui/components/heading";
import { Icon } from "@narsil-ui/components/icon";
import { cn } from "@narsil-ui/lib/utils";

type AccordionProps = {
  items: {
    uuid?: string;
    children: {
      content: string;
      trigger: string;
    };
  }[];
  layout: LayoutProps;
  nodeId?: string;
};

function Accordion({ items, layout, nodeId }: AccordionProps) {
  return (
    <Container
      paddingBottom={layout.padding.bottom}
      paddingTop={layout.padding.top}
      variant={layout.size}
      {...nodeAttributes(nodeId)}
    >
      <AccordionRoot className="w-full">
        {items.map((item, index) => {
          return (
            <AccordionItem value={index.toString()} {...nodeAttributes(item.uuid)} key={index}>
              <AccordionHeader
                render={
                  <Heading level="h2">
                    <AccordionTrigger>
                      {item.children.trigger}
                      <Icon
                        className={cn(
                          "pointer-events-none shrink-0 transition-transform duration-300 will-change-transform",
                          "group-aria-expanded/accordion-trigger:rotate-180",
                        )}
                        name="chevron-down"
                      />
                    </AccordionTrigger>
                  </Heading>
                }
              />
              <AccordionPanel>
                <div
                  className="prose pb-4"
                  dangerouslySetInnerHTML={{ __html: item.children.content }}
                />
              </AccordionPanel>
            </AccordionItem>
          );
        })}
      </AccordionRoot>
    </Container>
  );
}

export default Accordion;
