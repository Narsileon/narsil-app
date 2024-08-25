import { SharedProps } from "@narsil-ui/Types";
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
	};
};

export type InertiaPage = React.ReactNode & { props: GlobalProps };
