import { createInertiaApp } from "@inertiajs/react";
import createServer from "@inertiajs/react/server";
import { type ComponentProps } from "react";
import { renderToReadableStream, renderToString } from "react-dom/server";
import Layout from "./layouts/layout";

createServer(
  (page) =>
    createInertiaApp({
      page,
      render: (async (element: React.ReactNode) => {
        const stream = await renderToReadableStream(element);
        await stream.allReady;
        return new Response(stream).text();
      }) as unknown as typeof renderToString,
      resolve: (name) => {
        const appPages = import.meta.glob("@/pages/**/*.tsx", {
          eager: true,
        });

        const appKey = `/resources/js/pages/${name}.tsx`;

        // eslint-disable-next-line @typescript-eslint/no-explicit-any
        const page: any = appPages[appKey];

        if (!page) {
          throw new Error(`Page not found: ${name}`);
        }

        page.default.layout =
          page.default?.layout ||
          ((page: ComponentProps<typeof Layout>["children"]) => <Layout children={page} />);

        return page;
      },
      setup: ({ App, props }) => <App {...props} />,
    }),
  {
    cluster: true,
  },
);
