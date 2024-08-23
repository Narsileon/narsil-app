import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import path from "path";
import react from "@vitejs/plugin-react";

export default defineConfig({
	build: {
		rollupOptions: {
			output: {
				manualChunks(id) {
					if (id.includes("node_modules")) {
						if (id.includes("@radix-ui")) return "@radix-ui";
						if (id.includes("@dnd-kit")) return "@dnd-kit";
						if (id.includes("@tiptap")) return "@tiptap";
						if (id.includes("axios")) return "axios";
						if (id.includes("date-fns")) return "date-fns";
						if (id.includes("lodash")) return "lodash";
						if (id.includes("lucide-react")) return "lucide-react";
						if (id.includes("prosemirror")) return "prosemirror";
						if (id.includes("react-dom")) return "react-dom";
						if (id.includes("zod")) return "zod";
						return "vendor";
					}
				},
			},
		},
	},
	plugins: [
		laravel({
			input: ["resources/css/app.scss", "resources/js/app.tsx"],
			refresh: true,
		}),
		react(),
	],
	resolve: {
		alias: {
			"@": path.join(__dirname, "/resources/js"),
			"@narsil-auth": path.join(__dirname, "/vendor/narsil/auth/resources/js"),
			"@narsil-forms": path.join(__dirname, "/vendor/narsil/forms/resources/js"),
			"@narsil-localization": path.join(__dirname, "/vendor/narsil/localization/resources/js"),
			"@narsil-table": path.join(__dirname, "/vendor/narsil/table/resources/js"),
			"@narsil-ui": path.join(__dirname, "/vendor/narsil/ui/resources/js"),
			vendor: path.join(__dirname, "/vendor"),
		},
	},
});
