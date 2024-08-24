import { SharedProps } from "@narsil-ui/Types";

export type GlobalProps = {
	shared: SharedProps;
};

export type InertiaPage = React.ReactNode & { props: GlobalProps };
