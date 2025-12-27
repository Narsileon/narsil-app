import { Heading, Icon } from "@/blocks";
import {
  AccordionContent,
  AccordionHeader,
  AccordionItem,
  AccordionRoot,
  AccordionTrigger,
} from "@/components/accordion";
import { SitePageBlock } from "@/types";

type AccordionProps = {
  accordion_builder: SitePageBlock &
    {
      accordion_item_content: string;
      accordion_item_trigger: string;
    }[];
};

function Accordion({ accordion_builder }: AccordionProps) {
  return (
    <AccordionRoot className="min-w-96" collapsible={true} type="single">
      {accordion_builder.map((item, index) => {
        return (
          <AccordionItem value={index.toString()} key={index}>
            <AccordionHeader asChild>
              <Heading level="h2">
                <AccordionTrigger>
                  {item.accordion_item_trigger}
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
                dangerouslySetInnerHTML={{ __html: item.accordion_item_content }}
              />
            </AccordionContent>
          </AccordionItem>
        );
      })}
    </AccordionRoot>
  );
}

export default Accordion;
