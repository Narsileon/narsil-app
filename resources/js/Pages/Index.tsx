import { useTranslationsStore } from "@narsil-localization/Stores/translationStore";
import AppHead from "@narsil-ui/Components/App/AppHead";

interface Props {}

const Index = ({}: Props) => {
	const { trans } = useTranslationsStore();

	return (
		<>
			<AppHead
				description={trans("Home")}
				keywords={trans("Home")}
				title={trans("Home")}
			/>
		</>
	);
};

export default Index;
