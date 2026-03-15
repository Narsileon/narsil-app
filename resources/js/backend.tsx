import { createInertiaApp, type ResolvedComponent } from "@inertiajs/react";
import bootFormPlugin from "@narsil-cms-form/index";
import bootCmsPlugin from "@narsil-cms/index";
import Layout from "@narsil-cms/layouts/layout";
import { type ComponentProps } from "react";
import { createRoot } from "react-dom/client";

createInertiaApp({
  resolve: (name) => {
    const [vendorPath, componentPath] = name.includes("::") ? name.split("::") : [null, name];

    const appPages = import.meta.glob<ResolvedComponent>("@/pages/backend/**/*.tsx", {
      eager: true,
    });

    const vendorPages = import.meta.glob<ResolvedComponent>(
      ["@narsil-cms/pages/**/*.tsx", "@narsil-ui/pages/**/*.tsx"],
      {
        eager: true,
      },
    );

    const appKey = `/resources/js/pages/backend/${componentPath}.tsx`;
    const vendorKey = `/vendor/${vendorPath}/resources/js/pages/${componentPath}.tsx`;

    // eslint-disable-next-line @typescript-eslint/no-explicit-any
    const page: any = appPages[appKey] ?? vendorPages[vendorKey];

    if (!page) {
      throw new Error(`Page not found: ${name}`);
    }

    page.default.layout =
      page.default?.layout ||
      ((page: ComponentProps<typeof Layout>["children"]) => <Layout children={page} />);

    return page;
  },
  setup({ el, App, props }) {
    bootCmsPlugin();
    bootFormPlugin();
    createRoot(el).render(<App {...props} />);
  },
});
