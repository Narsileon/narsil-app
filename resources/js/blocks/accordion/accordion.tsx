import { LayoutProps } from "@/types";
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
    children: {
      content: string;
      trigger: string;
    };
  }[];
  layout: LayoutProps;
};

function Accordion({ items, layout }: AccordionProps) {
  return (
    <Container
      paddingBottom={layout.padding.bottom}
      paddingTop={layout.padding.top}
      variant={layout.size}
    >
      <AccordionRoot className="w-full">
        {items.map((item, index) => {
          return (
            <AccordionItem value={index.toString()} key={index}>
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
