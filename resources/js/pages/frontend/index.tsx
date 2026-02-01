import { BlockRenderer } from "@/blocks";
import { Head } from "@inertiajs/react";
import { Container } from "@narsil-cms/components/container";
import { Fragment } from "react";

function Page({ footer, page }: App.Http.Data.GlobalData) {
  const organization = {
    "@context": "https://schema.org",
    "@type": "Organization",
    name: footer.organization,
    url: window.location.origin,
    logo: `${window.location.origin}/favicon.svg`,
    address: {
      "@type": "PostalAddress",
      streetAddress: footer.street,
      postalCode: footer.postal_code,
      addressLocality: footer.city,
      addressCountry: footer.country,
    },
    contactPoint: {
      "@type": "ContactPoint",
      telephone: footer.phone,
      email: footer.email,
    },
    sameAs: footer.social_media.map((socialMedium) => socialMedium.url),
  };

  return (
    <>
      <Head>
        <title>{page.title}</title>
        {/* Meta */}
        <meta
          name="description"
          content={page.meta_description ? page.meta_description : page.title}
        />
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
        {footer.organizationSchema ? (
          <script type="application/ld+json">{JSON.stringify(organization, null, 2)}</script>
        ) : null}
      </Head>
      <Container>
        {page.data
          ? Object.entries(page.data).map(([handle, element]) => {
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
          : null}
      </Container>
    </>
  );
}

export default Page;
