import { createInertiaApp } from "@inertiajs/react";
import { getInertiaAppOptions } from "@narsil-ui/Components/App/App";
import BackendLayout from "./Components/Layouts/Backend/BackendLayout";
import WebLayout from "./Components/Layouts/Web/WebLayout";

const backendLayout = (page: InertiaPage) => <BackendLayout children={page} />;
const webLayout = (page: InertiaPage) => <WebLayout children={page} />;

createInertiaApp(
	getInertiaAppOptions({
		layout: (path) => {
			return path.includes("Backend") ? backendLayout : webLayout;
		},
	})
);
