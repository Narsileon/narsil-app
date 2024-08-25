import { cn } from "@narsil-ui/Components";
import { GlobalProps } from "@/Types";
import { Globe, Hexagon, Menu, X } from "lucide-react";
import { Link, usePage } from "@inertiajs/react";
import { useTranslationsStore } from "@narsil-localization/Stores/translationStore";
import { useWindowScroll } from "react-use";
import * as React from "react";
import AppCopyright from "@narsil-ui/Components/App/AppCopyright";
import AppLanguage from "@narsil-localization/Components/App/AppLanguage";
import AppVersion from "@narsil-ui/Components/App/AppVersion";
import Button from "@narsil-ui/Components/Button/Button";
import Container from "@narsil-ui/Components/Container/Container";
import DropdownMenu from "@narsil-ui/Components/DropdownMenu/DropdownMenu";
import Layout from "@narsil-ui/Components/Layout/Layout";
import NavigationMenu from "@narsil-ui/Components/NavigationMenu/NavigationMenu";
import NavigationMenuItem from "@narsil-ui/Components/NavigationMenu/NavigationMenuItem";
import NavigationMenuList from "@narsil-ui/Components/NavigationMenu/NavigationMenuList";
import Sheet from "@narsil-ui/Components/Sheet/Sheet";
import SheetPortal from "@narsil-ui/Components/Sheet/SheetPortal";
import UserMenuDropdownContent from "@narsil-auth/Components/UserMenu/UserMenuDropdownContent";
import UserMenuSheetContent from "@narsil-auth/Components/UserMenu/UserMenuSheetContent";
import UserMenuTrigger from "@narsil-auth/Components/UserMenu/UserMenuTrigger";
import useScreenStore from "@narsil-ui/Stores/screenStore";
import ThemeController from "@narsil-ui/Components/Themes/ThemeController";

interface Props {
	children?: React.ReactNode;
}

const WebLayout = ({ children }: Props) => {
	const { isMobile } = useScreenStore();
	const { trans } = useTranslationsStore();

	const shared = usePage<GlobalProps>().props.shared;

	const [showHeader, setShowHeader] = React.useState(true);
	const [showMenu, setShowMenu] = React.useState(false);

	const userPortal = React.useRef<HTMLDivElement>(null);

	const scrolling = useWindowScroll();

	const [previousScrolling, setPreviousScrolling] = React.useState({
		x: 0,
		y: 0,
	});

	React.useEffect(() => {
		const delta = scrolling.y - previousScrolling.y;

		if (delta < -10) {
			setPreviousScrolling(scrolling);
			setShowHeader(true);
		} else if (delta > 10 && scrolling.y > (userPortal.current?.offsetTop ?? 0)) {
			setPreviousScrolling(scrolling);
			setShowHeader(false);
		}
	}, [scrolling]);

	return (
		<Layout
			className={cn("relative", { "max-h-screen": showMenu })}
			defaultColor='blue'
		>
			<Sheet
				modal={false}
				open={showMenu}
				onOpenChange={setShowMenu}
			>
				<header
					className={cn("sticky top-0 z-10 w-full transition-transform will-change-transform")}
					style={{
						transform: `translate(0%, -${!isMobile && showHeader ? 0 : scrolling.y}px)`,
					}}
				>
					<div className='bg-primary text-primary-foreground'>
						<Container className='grid grid-cols-2 justify-between'>
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
							<ThemeController
								className='place-self-end self-center'
								enableRadius={false}
							/>
						</Container>
					</div>

					<div className='bg-background text-foreground shadow'>
						<Container className='grid grid-cols-2 justify-between py-4'>
							<div className='flex items-center place-self-start self-center'>
								<Link
									className='text-2xl font-bold'
									href={route("home")}
								>
									NARSIL
								</Link>
							</div>

							<DropdownMenu>
								<UserMenuTrigger
									className='place-self-end self-center'
									asChild={true}
								>
									<Button
										size='icon'
										variant='ghost'
									>
										{showMenu ? <X /> : <Menu />}
									</Button>
								</UserMenuTrigger>
								<UserMenuDropdownContent
									authenticated={shared.auth ? true : false}
									registerable={shared.app.registerable}
								/>
							</DropdownMenu>
						</Container>
					</div>

					{/* <Container>
                        <AppBreadcrumb />
                    </Container> */}
				</header>

				<Container
					ref={userPortal}
					className={cn("relative w-full grow p-0", { "overflow-hidden": showMenu })}
				>
					<SheetPortal container={userPortal.current}>
						<UserMenuSheetContent
							authenticated={shared.auth ? true : false}
							registerable={shared.app.registerable}
							onInteractOutside={(event) => event.preventDefault()}
						/>
					</SheetPortal>
					{children}
				</Container>

				<footer className='absolute bottom-0 w-full translate-y-full'>
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
								<NavigationMenuList className='flex flex-wrap gap-4'>
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
			</Sheet>
		</Layout>
	);
};

export default WebLayout;
