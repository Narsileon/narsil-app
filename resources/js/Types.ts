import { Collection, SharedProps } from "@narsil-ui/Types";
import { MenuNodeModel } from "@narsil-menus/Types";
import { NodeModel } from "@narsil-tree/Types";

export type GlobalProps = {
	shared: SharedProps & {
		app: {
			registerable: boolean;
		};
		menus: {
			backend: Collection<NodeModel<MenuNodeModel>>;
			frontend: Collection<NodeModel<MenuNodeModel>>;
			header: Collection<NodeModel<MenuNodeModel>>;
		};
	};
};

export type InertiaPage = React.ReactNode & { props: GlobalProps };
