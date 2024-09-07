import { useTranslationsStore } from "@narsil-localization/Stores/translationStore";
import Image from "@narsil-ui/Components/Image/Image";
import ScrollArea from "@narsil-ui/Components/ScrollArea/ScrollArea";
import Section from "@narsil-ui/Components/Section/Section";
import WebLayout from "@/Components/Layout/WebLayout";

interface Props {
	children?: React.ReactNode;
}

const SessionLayout = ({ children }: Props) => {
	const { trans } = useTranslationsStore();

	return (
		<WebLayout>
			<div className='flex h-fit w-full'>
				<Section className='hidden h-fit overflow-hidden lg:block lg:w-6/12 xl:w-8/12'>
					<Image
						className='h-full w-full border-none object-contain object-center'
						src='https://placehold.co/600x600?text=Hello+World'
						alt={trans("validation.attributes.background")}
					/>
				</Section>
				<ScrollArea className='h-fit w-full lg:w-6/12 xl:w-4/12'>{children}</ScrollArea>
			</div>
		</WebLayout>
	);
};

export default SessionLayout;
