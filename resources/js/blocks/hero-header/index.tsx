import { Container, Heading } from "@/blocks";
import { set } from "lodash-es";
import { ComponentProps } from "react";
import BlockRenderer from "../block-renderer";

type HeroHeaderProps = {
  excerpt: string;
  headline: {
    headline: string;
    headline_level: ComponentProps<typeof Heading>["level"];
    headline_style: ComponentProps<typeof Heading>["variant"];
  };
  buttons: unknown[];
};

function HeroHeader({ excerpt, headline, buttons }: HeroHeaderProps) {
  return (
    <Container>
      <Heading level={headline.headline_level} variant={headline.headline_style}>
        {headline.headline}
      </Heading>
      <div dangerouslySetInnerHTML={{ __html: excerpt }} />
      {buttons?.map((button, index) => {
        set(
          button,
          "children.className",
          "transition-transform duration-200 will-change-transform hover:scale-105",
        );

        set(button, "children.size", "lg");

        return <BlockRenderer block={button} key={index} />;
      })}
    </Container>
  );
}

export default HeroHeader;
