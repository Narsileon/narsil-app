import { Accordion } from "@/blocks/accordion";
import { Button } from "@/blocks/button";
import { CallToAction } from "@/blocks/call-to-action";
import { Form } from "@/blocks/form";
import { HeroHeader } from "@/blocks/hero-header";

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
  ["call_to_action"]: CallToAction,
  ["hero_header"]: HeroHeader,
  ["form"]: Form,
};

type BlockName = keyof typeof blocks;

function BlockRenderer({ block, ...props }: BlockRendererProps) {
  const BlockComponent = blocks[block.handle as BlockName];

  return BlockComponent ? <BlockComponent {...block.children} {...props} /> : null;
}

export default BlockRenderer;
