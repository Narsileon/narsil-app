import { GlobalProps } from "@/Types";
import { Hexagon } from "lucide-react";
import { Link, usePage } from "@inertiajs/react";
import { useClickAway } from "react-use";
import { useTranslationsStore } from "@narsil-localization/Stores/translationStore";
import * as React from "react";
import AppCopyright from "@narsil-ui/Components/App/AppCopyright";
import AppLanguage from "@narsil-localization/Components/App/AppLanguage";
import AppVersion from "@narsil-ui/Components/App/AppVersion";
import Button from "@narsil-ui/Components/Button/Button";
import Container from "@narsil-ui/Components/Container/Container";
import Layout from "@narsil-ui/Components/Layout/Layout";
import LayoutUserMenu from "@narsil-auth/Components/Layout/LayoutUserMenu";
import NavigationMenu from "@narsil-ui/Components/NavigationMenu/NavigationMenu";
import NavigationMenuItem from "@narsil-ui/Components/NavigationMenu/NavigationMenuItem";
import NavigationMenuList from "@narsil-ui/Components/NavigationMenu/NavigationMenuList";
import useScreenStore from "@narsil-ui/Stores/screenStore";

interface Props {
	children?: React.ReactNode;
}

const WebLayout = ({ children }: Props) => {
	const { trans } = useTranslationsStore();

	const shared = usePage<GlobalProps>().props.shared;

	const auth = shared.auth;
	const localization = shared.localization;
	const headerMenu = shared.menus?.headerMenu;

	const headerRef = React.useRef<HTMLDivElement>(null);

	const [headerHeight, setHeaderHeight] = React.useState(0);

	const { isDesktop, isMobile } = useScreenStore();

	const [scrollingDown, setScrollingDown] = React.useState(false);
	const [open, setOpen] = React.useState(false);

	const menu: React.RefObject<HTMLUListElement> = React.useRef<HTMLUListElement>(null);

	useClickAway(menu, () => {
		setOpen(false);
	}, ["mouseup"]);

	// const DesktopUserMenu = <UserMenu />;

	// const MobileUserMenu = (
	// 	<AsideMenu visible={open}>
	// 		<UserMenu />
	// 	</AsideMenu>
	// );

	React.useEffect(() => {
		if (headerRef.current) {
			const height = headerRef.current.getBoundingClientRect().height;

			setHeaderHeight(height);
		}
	}, [headerRef]);

	return (
		<Layout className='relative'>
			<header
				ref={headerRef}
				className='sticky top-0 z-10 w-full bg-primary text-primary-foreground'
			>
				<Container className='grid grid-cols-2 justify-between py-4'>
					<div className='flex items-center place-self-start self-center'>
						<Link href={route("home")}>
							<Hexagon />
						</Link>
					</div>
					<div className='flex items-center place-self-end self-center'>
						<AppLanguage
							languages={localization.languages}
							size='icon'
							variant='ghost'
						/>
						<LayoutUserMenu />
					</div>
				</Container>

				{/* <Container>
					<AppBreadcrumb />
				</Container> */}
			</header>

			<Container className='w-full grow p-0'>
				{/* {isMobile ? MobileUserMenu : null} */}
				{children}
			</Container>

			<footer className='absolute bottom-0 w-full translate-y-full'>
				<div className='bg-primary/80 text-primary-foreground'>
					<Container className='grid grid-cols-1 lg:grid-cols-2'>
						<AppLanguage
							className='place-self-start self-center bg-transparent hover:bg-transparent'
							languages={localization.languages}
							format='long'
							chevron={true}
							size='default'
							variant='link'
						/>
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
		</Layout>
	);
};

export default WebLayout;
