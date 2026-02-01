import { BlockRenderer } from "@/blocks";
import { useGlobal } from "@/providers/global";
import { LayoutProps } from "@/types";
import { Container } from "@narsil-cms/components/container";
import { Heading } from "@narsil-cms/components/heading";
import { set } from "lodash-es";
import { type ComponentProps } from "react";

type HeroHeaderProps = {
  buttons: unknown[];
  excerpt: string;
  headline: {
    headline: string;
    headline_level: ComponentProps<typeof Heading>["level"];
    headline_style: ComponentProps<typeof Heading>["variant"];
  };
  layout: LayoutProps;
};

function HeroHeader({ buttons, excerpt, headline, layout }: HeroHeaderProps) {
  const { headerHeight } = useGlobal();

  return (
    <Container
      className="justify-center"
      paddingBottom={layout.padding.bottom}
      paddingTop={layout.padding.top}
      variant={layout.size}
      style={{
        minHeight: `calc(100vh - ${headerHeight}px)`,
      }}
    >
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
