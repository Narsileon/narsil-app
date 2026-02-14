import Layout from "@/layouts/layout";
import { createInertiaApp } from "@inertiajs/react";
import { type ComponentProps } from "react";
import { createRoot, hydrateRoot } from "react-dom/client";

createInertiaApp({
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
  setup({ el, App, props }) {
    if (import.meta.env.DEV) {
      createRoot(el).render(<App {...props} />);
    } else {
      hydrateRoot(el, <App {...props} />);
    }
  },
});
