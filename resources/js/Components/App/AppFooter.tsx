import { Globe } from "lucide-react";
import { GlobalProps } from "@/Types";
import { Link, usePage } from "@inertiajs/react";
import { useTranslationsStore } from "@narsil-localization/Stores/translationStore";
import * as React from "react";
import AppCopyright from "@narsil-ui/Components/App/AppCopyright";
import AppLanguage from "@narsil-localization/Components/App/AppLanguage";
import AppVersion from "@narsil-ui/Components/App/AppVersion";
import Button from "@narsil-ui/Components/Button/Button";
import Container from "@narsil-ui/Components/Container/Container";
import NavigationMenu from "@narsil-ui/Components/NavigationMenu/NavigationMenu";
import NavigationMenuItem from "@narsil-ui/Components/NavigationMenu/NavigationMenuItem";
import NavigationMenuList from "@narsil-ui/Components/NavigationMenu/NavigationMenuList";

interface AppFooterProps extends React.HTMLAttributes<HTMLDivElement> {}

const AppFooter = React.forwardRef<HTMLDivElement, AppFooterProps>(({ ...props }, ref) => {
	const { trans } = useTranslationsStore();

	const shared = usePage<GlobalProps>().props.shared;

	return (
		<footer
			ref={ref}
			{...props}
		>
			<div className='bg-primary-highlight text-primary-highlight-foreground'>
				<Container className='grid grid-cols-1 lg:grid-cols-2'>
					<AppLanguage
						className='place-self-start self-center bg-transparent hover:bg-transparent'
						languages={shared.localization.languages}
						format='long'
						chevron={true}
						size='default'
						variant='link'
					>
						<Globe />
					</AppLanguage>
					<NavigationMenu className='place-self-start lg:place-self-end'>
						<NavigationMenuList className='flex flex-wrap space-x-4'>
							<NavigationMenuItem>
								<Button
									asChild={true}
									size='default'
									variant='link'
								>
									<Link
										href={route("imprint")}
										method='get'
									>
										{trans("Imprint")}
									</Link>
								</Button>
							</NavigationMenuItem>
							<NavigationMenuItem>
								<Button
									asChild={true}
									size='default'
									variant='link'
								>
									<Link
										href={route("privacy-notice")}
										method='get'
									>
										{trans("Privacy notice")}
									</Link>
								</Button>
							</NavigationMenuItem>
						</NavigationMenuList>
					</NavigationMenu>
				</Container>
			</div>

			<div className='bg-primary text-primary-foreground'>
				<Container className='grid grid-cols-2 py-4'>
					<AppCopyright
						className='place-self-start self-center'
						name={shared.app.name ?? "Narsil"}
					/>
					<AppVersion
						className='place-self-end self-center'
						version={shared.app.version ?? "1.0.0"}
					/>
				</Container>
			</div>
		</footer>
	);
});

export default AppFooter;
