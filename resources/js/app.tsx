import { createInertiaApp } from "@inertiajs/react";
import { getInertiaAppOptions } from "@narsil-ui/Components/App/App";
import { InertiaPage } from "./Types";
import BackendLayout from "@/Components/Layout/BackendLayout";
import WebLayout from "@/Components/Layout/WebLayout";
import SessionLayout from "./Components/Layout/SessionLayout";

createInertiaApp(
	getInertiaAppOptions({
		layout: (path) => (page: InertiaPage) => {
			switch (page.props.layout) {
				case "session":
					return <SessionLayout children={page} />;
				default:
					return path.includes("Backend") ? <BackendLayout children={page} /> : <WebLayout children={page} />;
			}
		},
	})
);
