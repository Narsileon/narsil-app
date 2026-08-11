import { Accordion } from "@/blocks/accordion";
import { Button } from "@/blocks/button";
import { CallToAction } from "@/blocks/call-to-action";
import { Form } from "@/blocks/form";
import { HeroHeader } from "@/blocks/hero-header";
import { type ComponentType } from "react";

type BlockRendererProps = {
  block: {
    handle: string;
    uuid?: string;
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
  const BlockComponent = blocks[block.handle as BlockName] as
    ComponentType<Record<string, unknown>> | undefined;

  // nodeId lets the live editor map a rendered block back to its entity node.
  const blockProps = { ...block.children, nodeId: block.uuid, ...props };

  return BlockComponent ? <BlockComponent {...blockProps} /> : null;
}

export default BlockRenderer;
