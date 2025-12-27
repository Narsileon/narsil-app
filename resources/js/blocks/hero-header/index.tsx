import { Container, Heading } from "@/blocks";
import type { SitePageBlock } from "@/types";
import BlockRenderer from "../block-renderer";

type HeroHeaderProps = {
  excerpt: string;
  headline: string;
  hero_header_buttons: SitePageBlock[];
};

function HeroHeader({ excerpt, headline, hero_header_buttons }: HeroHeaderProps) {
  return (
    <Container>
      <Heading level="h1" variant="h1">
        {headline}
      </Heading>
      <div dangerouslySetInnerHTML={{ __html: excerpt }} />
      {hero_header_buttons.map((button, index) => {
        button = {
          ...button,
          className: "transition-transform duration-200 will-change-transform hover:scale-105",
          size: "lg",
        };

        return <BlockRenderer block={button} key={index} />;
      })}
    </Container>
  );
}

export default HeroHeader;
