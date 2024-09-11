import { useTranslationsStore } from "@narsil-localization/Stores/translationStore";
import AppHead from "@narsil-ui/Components/App/AppHead";

interface Props {}

const Index = ({}: Props) => {
	const { trans } = useTranslationsStore();

	const homeLabel = trans("Home");

	return (
		<>
			<AppHead
				description={homeLabel}
				keywords={homeLabel}
				title={homeLabel}
			/>
		</>
	);
};

export default Index;
