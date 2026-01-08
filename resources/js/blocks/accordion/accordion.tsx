import { Container } from "@/blocks/container";
import { Heading } from "@/blocks/heading";
import { Icon } from "@/blocks/icon";
import {
  AccordionContent,
  AccordionHeader,
  AccordionItem,
  AccordionRoot,
  AccordionTrigger,
} from "@/components/accordion";
import { LayoutProps } from "@/types";

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
      <AccordionRoot className="w-full" collapsible={true} type="single">
        {accordion_builder.map((item, index) => {
          return (
            <AccordionItem value={index.toString()} key={index}>
              <AccordionHeader asChild>
                <Heading level="h2">
                  <AccordionTrigger>
                    {item.children.accordion_item_trigger}
                    <Icon
                      className={
                        "transition-transform duration-300 will-change-transform group-data-[state=open]:rotate-180"
                      }
                      name="chevron-down"
                    />
                  </AccordionTrigger>
                </Heading>
              </AccordionHeader>
              <AccordionContent>
                <div
                  className="prose pb-4"
                  dangerouslySetInnerHTML={{ __html: item.children.accordion_item_content }}
                />
              </AccordionContent>
            </AccordionItem>
          );
        })}
      </AccordionRoot>
    </Container>
  );
}

export default Accordion;
