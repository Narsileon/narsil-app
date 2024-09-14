import { createInertiaApp } from "@inertiajs/react";
import { getInertiaAppOptions } from "@narsil-ui/Components/App/App";
import { GlobalProps } from "@/Types";
import { InertiaPage } from "./Types";
import BackendLayout from "@/Components/Layout/BackendLayout";
import SessionLayout from "@/Components/Layout/SessionLayout";
import WebLayout from "@/Components/Layout/WebLayout";

createInertiaApp(
	getInertiaAppOptions({
		layout: (path) => (page: InertiaPage) => {
			const props: GlobalProps = page.props;

			switch (page.props.layout) {
				case "session":
					return <SessionLayout children={page} />;
				default:
					return props.shared.ziggy.url.includes("backend") ? (
						<BackendLayout children={page} />
					) : (
						<WebLayout
							breadcrumb={page.props.breadcrumb}
							children={page}
						/>
					);
			}
		},
	})
);
