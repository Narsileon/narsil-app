import { Button, Container, Heading } from "@/blocks";
import BlockRenderer from "@/blocks/block-renderer";
import { GlobalProps } from "@/types";
import { Head, Link } from "@inertiajs/react";

function Page({ page }: GlobalProps) {
  return (
    <>
      <Head>
        <title>{page.title}</title>
        {/* Meta */}
        {page.meta_description && <meta name="description" content={page.meta_description} />}
        {/* Open Graph */}
        <meta property="og:type" content={page.open_graph_type || "website"} />
        <meta property="og:title" content={page.open_graph_title || page.title} />
        {page.open_graph_image && <meta property="og:image" content={page.open_graph_image} />}
        {page.open_graph_description || page.meta_description ? (
          <meta
            property="og:description"
            content={page.open_graph_description || (page.meta_description as string)}
          />
        ) : null}
      </Head>
      <Container>
        {page.content ? (
          page.content.blocks.map((block, index) => {
            return <BlockRenderer block={block} key={index} />;
          })
        ) : (
          <div className="flex flex-col gap-8">
            <Heading level="h1" variant="h4">
              No content?
            </Heading>
            <Button>
              <Link href="/narsil/dashboard">Visit Admin Panel</Link>
            </Button>
          </div>
        )}
      </Container>
    </>
  );
}

export default Page;
