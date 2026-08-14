import inertia from "@inertiajs/vite";
import tailwindcss from "@tailwindcss/vite";
import react from "@vitejs/plugin-react";
import laravel from "laravel-vite-plugin";
import path, { dirname } from "node:path";
import { fileURLToPath } from "node:url";
import { defineConfig, loadEnv } from "vite";

export default defineConfig(({ mode }) => {
  const env = loadEnv(mode, process.cwd(), "");

  const isProduction = mode === "production";

  const __dirname = dirname(fileURLToPath(import.meta.url));

  return {
    build: {
      cssMinify: true,
      minify: true,
    },
    plugins: [
      laravel({
        input: [
          "resources/css/backend.css",
          "resources/css/frontend.css",
          "resources/js/backend.tsx",
          "resources/js/frontend.tsx",
        ],
        refresh: true,
      }),
      inertia({
        ssr: isProduction
          ? {
              cluster: true,
              entry: "resources/js/ssr.tsx",
            }
          : false,
      }),
      react(),
      tailwindcss(),
    ],
    resolve: {
      alias: {
        "@": path.join(__dirname, "/resources/js"),
        "@narsil-cms": path.join(__dirname, "/vendor/narsil/cms/resources/js"),
        "@narsil-cms-form": path.join(__dirname, "/vendor/narsil/cms-form/resources/js"),
        "@narsil-ui": path.join(__dirname, "/vendor/narsil/base/resources/js"),
      },
      preserveSymlinks: true,
    },
    server: {
      allowedHosts: true,
      cors: {
        origin: /https?:\/\/([A-Za-z0-9\-\.]+)?(localhost|\.local|\.test|\.site)(?::\d+)?$/,
      },
      fs: {
        strict: false,
      },
      headers: {
        "Access-Control-Allow-Private-Network": "true",
      },
      host: "0.0.0.0",
      origin: env.APP_URL + ":5173",
      port: 5173,
      strictPort: true,
    },
  };
});
