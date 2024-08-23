import { usePage } from "@inertiajs/react";
import Image from "@narsil-ui/Components/Image/Image";
import ScrollArea from "@narsil-ui/Components/ScrollArea/ScrollArea";
import Section from "@narsil-ui/Components/Section/Section";
import WebLayout from "@/Components/Layout/WebLayout";

interface Props {
	children?: React.ReactNode;
}

const SessionLayout = ({ children }: Props) => {
	const page = usePage<GlobalProps & { background: ImageModel }>();

	const background = page.props.background;

	return (
		<WebLayout>
			<div className='flex h-full w-full'>
				<Section className='hidden h-full overflow-hidden lg:block lg:w-6/12 xl:w-8/12'>
					{background ? (
						<Image
							className='h-full w-full object-contain object-center'
							src={background}
						/>
					) : null}
				</Section>
				<ScrollArea className='h-full w-full lg:w-6/12 xl:w-4/12'>{children}</ScrollArea>
			</div>
		</WebLayout>
	);
};

export default SessionLayout;
