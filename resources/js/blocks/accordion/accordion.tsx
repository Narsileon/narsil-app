import { Container } from "@/blocks/container";
import { Icon } from "@/blocks/icon";
import { LayoutProps } from "@/types";
import { Heading } from "@narsil-cms/blocks/heading";
import {
  AccordionHeader,
  AccordionItem,
  AccordionPanel,
  AccordionRoot,
  AccordionTrigger,
} from "@narsil-cms/components/accordion";
import { cn } from "@narsil-cms/lib/utils";

type AccordionProps = {
  accordion_builder: {
    children: {
      accordion_item_content: string;
      accordion_item_trigger: string;
    };
  }[];
  layout: LayoutProps;
};

function Accordion({ accordion_builder, layout }: AccordionProps) {
  return (
    <Container
      paddingBottom={layout.padding.bottom}
      paddingTop={layout.padding.top}
      variant={layout.size}
    >
      <AccordionRoot className="w-full">
        {accordion_builder.map((item, index) => {
          return (
            <AccordionItem value={index.toString()} key={index}>
              <AccordionHeader
                render={
                  <Heading level="h2">
                    <AccordionTrigger>
                      {item.children.accordion_item_trigger}
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
                  dangerouslySetInnerHTML={{ __html: item.children.accordion_item_content }}
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
