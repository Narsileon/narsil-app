import { Collection, SharedProps } from "@narsil-ui/Types";
import { MenuNodeModel } from "@narsil-menus/Types";
import { NodeModel } from "@narsil-tree/Types";
import { UserModel } from "@narsil-auth/Types";

export type GlobalProps = {
	shared: SharedProps & {
		app: {
			registerable: boolean;
		};
		auth: {
			id: UserModel["id"];
			full_name: UserModel["full_name"];
			username: UserModel["username"];
		};
		menus: {
			backend: Collection<NodeModel<MenuNodeModel>>;
			frontend: Collection<NodeModel<MenuNodeModel>>;
			header: Collection<NodeModel<MenuNodeModel>>;
		};
	};
};

export type InertiaPage = React.ReactNode & { props: GlobalProps };
