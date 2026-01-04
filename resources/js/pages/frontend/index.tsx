import { BlockRenderer } from "@/blocks";
import { Button } from "@/blocks/button";
import { Container } from "@/blocks/container";
import { Heading } from "@/blocks/heading";
import { GlobalProps } from "@/types";
import { Head } from "@inertiajs/react";
import { Fragment } from "react/jsx-runtime";

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
        {page.data ? (
          Object.entries(page.data).map(([handle, element]) => {
            if (Array.isArray(element)) {
              return (
                <Fragment key={handle}>
                  {element.map((block, index) => {
                    return <BlockRenderer block={block} key={index} />;
                  })}
                </Fragment>
              );
            }
            return <BlockRenderer block={element} key={handle} />;
          })
        ) : (
          <div className="flex flex-col gap-8">
            <Heading level="h1" variant="h4">
              No content?
            </Heading>
            <Button asChild={true}>
              <a href="/narsil/dashboard" target="_blank">
                Visit Admin Panel
              </a>
            </Button>
          </div>
        )}
      </Container>
    </>
  );
}

export default Page;
