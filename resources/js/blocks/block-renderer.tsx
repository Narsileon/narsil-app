import Accordion from "./accordion";
import Button from "./button";
import Form from "./form";
import HeroHeader from "./hero-header";

type BlockRendererProps = {
  block: {
    handle: string;
    children: Record<string, unknown>;
  };
  [key: string]: unknown;
};

const blocks = {
  ["accordion"]: Accordion,
  ["button"]: Button,
  ["hero_header"]: HeroHeader,
  ["form"]: Form,
};

type BlockName = keyof typeof blocks;

function BlockRenderer({ block, ...props }: BlockRendererProps) {
  const BlockComponent = blocks[block.handle as BlockName];

  return BlockComponent ? <BlockComponent {...block.children} {...props} /> : null;
}

export default BlockRenderer;
