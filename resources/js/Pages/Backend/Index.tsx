import { useTranslationsStore } from "@narsil-localization/Stores/translationStore";
import AppHead from "@narsil-ui/Components/App/AppHead";

interface Props {}

const Index = ({}: Props) => {
	const { trans } = useTranslationsStore();

	const dashboardLabel = trans("Dashboard");

	return (
		<>
			<AppHead
				description={dashboardLabel}
				keywords={dashboardLabel}
				title={dashboardLabel}
			/>
		</>
	);
};

export default Index;
