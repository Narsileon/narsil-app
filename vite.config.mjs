import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import path from "path";
import react from "@vitejs/plugin-react";

export default defineConfig({
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
			"@narsil-menus": path.join(__dirname, "/vendor/narsil/menus/resources/js"),
			"@narsil-tables": path.join(__dirname, "/vendor/narsil/tables/resources/js"),
			"@narsil-ui": path.join(__dirname, "/vendor/narsil/ui/resources/js"),
			vendor: path.join(__dirname, "/vendor"),
		},
	},
});
