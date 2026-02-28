import { BlockRenderer } from "@/blocks";
import { useGlobal } from "@/providers/global";
import { LayoutProps } from "@/types";
import { Container } from "@narsil-ui/components/container";
import { Heading } from "@narsil-ui/components/heading";
import { set } from "lodash-es";
import { type ComponentProps } from "react";

type HeroHeaderProps = {
  buttons: unknown[];
  excerpt: string;
  headline: {
    level: ComponentProps<typeof Heading>["level"];
    style: ComponentProps<typeof Heading>["variant"];
    title: string;
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
      <Heading level={headline.level} variant={headline.style}>
        {headline.title}
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
