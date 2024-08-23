import { Home } from "lucide-react";
import { router, usePage } from "@inertiajs/react";
import { useClickAway } from "react-use";
import { useTranslationsStore } from "@narsil-localization/Stores/translationStore";
import * as React from "react";
import AppLanguage from "@narsil-ui/Components/App/AppLanguage";
import Button from "@narsil-ui/Components/Button/Button";
import Container from "@narsil-ui/Components/Container/Container";
import ThemeController from "@narsil-ui/Components/Themes/ThemeController";
import TooltipWrapper from "@narsil-ui/Components/Tooltip/TooltipWrapper";

import {
	AppBreadcrumb,
	AppFooter,
	AppLogo,
	AppNotifications,
	AsideMenu,
	FlexWrapper,
	HorizontalMenu,
	UserMenu,
} from "@narsil-framework/Components";
import Layout from "@narsil-ui/Components/Layout/Layout";
import AppCopyright from '@narsil-ui/Components/App/AppCopyright';
import AppVersion from '@narsil-ui/Components/App/AppVersion';

interface Props {
	children?: React.ReactNode;
}

const WebLayout = ({ children }: Props) => {
	const { trans } = useTranslationsStore();

	const shared = usePage<GlobalProps>().props.shared;

	const auth = shared.auth;
	const localization = shared.localization;
	const headerMenu = shared.menus.headerMenu;

	const headerRef = React.useRef<HTMLDivElement>(null);

	const [headerHeight, setHeaderHeight] = React.useState(0);

	const { isDesktop, isMobile } = useScreenStore();

	const [scrollingDown, setScrollingDown] = React.useState(false);
	const [open, setOpen] = React.useState(false);

	const menu: React.RefObject<HTMLUListElement> = React.useRef<HTMLUListElement>(null);

	useClickAway(menu, () => {
		setOpen(false);
	}, ["mouseup"]);

	const DesktopUserMenu = <UserMenu />;

	const MobileUserMenu = (
		<AsideMenu visible={open}>
			<UserMenu />
		</AsideMenu>
	);

	React.useEffect(() => {
		if (headerRef.current) {
			const height = headerRef.current.getBoundingClientRect().height;

			setHeaderHeight(height);
		}
	}, [headerRef]);

	return (
		<Layout>
			<header
				ref={headerRef}
				className='sticky top-0 z-10 w-full border-b bg-background'
			>
				<div className='relative shadow-md'>
					<Container className='flex items-center justify-between'>
						<FlexWrapper
							className='sm:space-x-default py-4'
							justify='start'
							width='w-fit'
						>
							<AppLogo />

							{auth ? (
								<TooltipWrapper tooltip={trans("tooltips.back_to_your_homepage")}>
									<Button
										onClick={() => router.get(route("start"))}
										size='icon'
										variant='ghost'
									>
										<Home />
									</Button>
								</TooltipWrapper>
							) : null}
						</FlexWrapper>

						<HorizontalMenu menu={headerMenu} />

						<div className='right-4 flex items-center justify-end gap-x-2'>
							{auth ? <AppNotifications /> : null}
							<AppLanguage
								languages={localization.languages}
								locale={localization.locale}
							/>
							<ThemeController />
							{isDesktop ? (
								DesktopUserMenu
							) : (
								<Button
									className='sm:hidden'
									icon={open ? "fas fa-x" : "fas fa-bars"}
									iconClassName={open ? "w-5 h-5" : undefined}
									tooltip={trans("tooltips.menu")}
									onClick={() => setOpen(!open)}
								></Button>
							)}
						</div>
					</Container>
				</div>

				<Container>
					<AppBreadcrumb />
				</Container>
			</header>

			<Container className='w-full grow p-0'>
				{isMobile ? MobileUserMenu : null}
				{children}
			</Container>

			<footer className='w-full border-t'>
				<Container className='py-2'>
					<AppCopyright name={app.name} />
					{FooterMenu}
                    <AppVersion version='1.0.0' />
            
				</Container>
			</footer>
		</Layout>
	);
};

export default WebLayout;
