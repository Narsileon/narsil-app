import { useTranslationsStore } from "@narsil-localization/Stores/translationStore";
import AppHead from "@narsil-ui/Components/App/AppHead";
import Container from "@narsil-ui/Components/Container/Container";
import Heading from "@narsil-ui/Components/Heading/Heading";

interface Props {
	status: number | string;
}

const Index = ({ status }: Props) => {
	const { trans } = useTranslationsStore();

	const title = trans(`errors.${status}.title`);
	const description = trans(`errors.${status}.description`);

	return (
		<>
			<AppHead
				description={description}
				title={title}
				keywords={status as string}
			/>
			<Container className='flex h-full items-center justify-center'>
				<div className='flex flex-col items-center justify-center gap-4'>
					<Heading
						className='text-center'
						variant='h3'
					>{`${status} | ${title}`}</Heading>

					<div className='text-center text-xl'>{description}</div>
				</div>
			</Container>
		</>
	);
};

export default Index;
