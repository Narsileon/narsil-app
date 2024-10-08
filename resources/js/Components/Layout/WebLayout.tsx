import { ChartPie, Globe, Menu, User, X } from "lucide-react";
import { cn } from "@narsil-ui/Components";
import { Link, usePage } from "@inertiajs/react";
import { navigationMenuTriggerStyle } from "@narsil-ui/Components/NavigationMenu/NavigationMenuTrigger";
import { useTranslationsStore } from "@narsil-localization/Stores/translationStore";
import { useWindowScroll } from "react-use";
import * as React from "react";
import AppBreadcrumb from "@narsil-ui/Components/App/AppBreadcrumb";
import AppFooter from "@/Components/App/AppFooter";
import AppLanguage from "@narsil-localization/Components/App/AppLanguage";
import Button from "@narsil-ui/Components/Button/Button";
import Container from "@narsil-ui/Components/Container/Container";
import DropdownMenu from "@narsil-ui/Components/DropdownMenu/DropdownMenu";
import DropdownMenuItem from "@narsil-ui/Components/DropdownMenu/DropdownMenuItem";
import Layout from "@narsil-ui/Components/Layout/Layout";
import NavigationMenuItem from "@narsil-ui/Components/NavigationMenu/NavigationMenuItem";
import Sheet from "@narsil-ui/Components/Sheet/Sheet";
import SheetClose from "@narsil-ui/Components/Sheet/SheetClose";
import SheetDescription from "@narsil-ui/Components/Sheet/SheetDescription";
import SheetHeader from "@narsil-ui/Components/Sheet/SheetHeader";
import SheetPortal from "@narsil-ui/Components/Sheet/SheetPortal";
import SheetTitle from "@narsil-ui/Components/Sheet/SheetTitle";
import ThemeController from "@narsil-ui/Components/Themes/ThemeController";
import type { BreadcrumbType } from "@narsil-ui/Components/App/AppBreadcrumb";
import type { GlobalProps } from "@/Types";
import UserMenuDropdownContent from "@narsil-auth/Components/UserMenu/UserMenuDropdownContent";
import UserMenuSheetContent from "@narsil-auth/Components/UserMenu/UserMenuSheetContent";
import UserMenuTrigger from "@narsil-auth/Components/UserMenu/UserMenuTrigger";
import useScreenStore from "@narsil-ui/Stores/screenStore";

interface Props {
	breadcrumb?: BreadcrumbType[];
	children?: React.ReactNode;
}

const WebLayout = ({ breadcrumb, children }: Props) => {
	const { trans } = useTranslationsStore();

	const { isMobile } = useScreenStore();

	const shared = usePage<GlobalProps>().props.shared;

	const headerRef = React.useRef<HTMLDivElement>(null);
	const metaRef = React.useRef<HTMLDivElement>(null);
	const portalRef = React.useRef<HTMLDivElement>(null);

	const [portalOpen, setPortalOpen] = React.useState(false);

	const scrolling = useWindowScroll();

	const [previousScrolling, setPreviousScrolling] = React.useState({
		x: 0,
		y: 0,
	});

	const [showHeader, setShowHeader] = React.useState(true);

	React.useEffect(() => {
		if (!isMobile) {
			setPortalOpen(false);
		}
	}, [isMobile]);

	React.useEffect(() => {
		const delta = scrolling.y - previousScrolling.y;

		if (delta < -10) {
			setPreviousScrolling(scrolling);
			setShowHeader(true);
		} else if (delta > 10 && scrolling.y > (portalRef.current?.offsetTop ?? 0)) {
			setPreviousScrolling(scrolling);
			setShowHeader(false);
		}
	}, [scrolling]);

	return (
		<Layout
			className={cn("relative", { "max-h-screen": portalOpen })}
			defaultColor='blue'
		>
			<Sheet
				modal={false}
				open={portalOpen}
				onOpenChange={setPortalOpen}
			>
				<div
					ref={metaRef}
					className='bg-primary-highlight text-primary-highlight-foreground dark:bg-primary dark:text-primary-highlight-foreground'
				>
					<Container className='grid grid-cols-2 justify-between'>
						<AppLanguage
							className='place-self-start self-center bg-transparent hover:bg-transparent'
							chevron={true}
							languages={shared.localization.languages}
							short={false}
							size='default'
							variant='link'
						>
							<Globe />
						</AppLanguage>
						<ThemeController
							className='place-self-end self-center hover:bg-primary-highlight hover:text-primary-highlight-foreground'
							enableRadius={false}
						/>
					</Container>
				</div>
				<header
					ref={headerRef}
					className={cn(
						"z-10 w-full transition-transform will-change-transform",
						isMobile || scrolling.y > 0 ? "sticky top-0" : "duration-0"
					)}
					style={{
						transform:
							scrolling.y > 0 ? `translate(0%, -${isMobile || showHeader ? 0 : scrolling.y}px)` : "none",
					}}
				>
					<div className='bg-background text-foreground shadow'>
						<Container className='grid grid-cols-2 justify-between py-4'>
							<div className='flex items-center place-self-start self-center'>
								<Link
									className='flex items-center gap-2 text-2xl font-bold'
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
										{portalOpen ? <X /> : <Menu />}
										<span className='sr-only'>{trans(portalOpen ? "Close" : "Menu")}</span>
									</Button>
								</UserMenuTrigger>
								<UserMenuDropdownContent
									authenticated={shared.auth ? true : false}
									registerable={shared.app.registerable}
								>
									{shared.auth ? (
										<>
											<DropdownMenuItem asChild={true}>
												<a
													href={route("backend.dashboard")}
													target='_blank'
												>
													<ChartPie className='h-5 w-5' />
													{trans("Dashboard")}
												</a>
											</DropdownMenuItem>
											<DropdownMenuItem
												active={route().current() === "profile"}
												asChild={true}
											>
												<Link href={route("profile")}>
													<User className='h-5 w-5' />
													{trans("Profile")}
												</Link>
											</DropdownMenuItem>
										</>
									) : null}
								</UserMenuDropdownContent>
							</DropdownMenu>
						</Container>
					</div>
				</header>

				<div
					ref={portalRef}
					className={cn("relative", { "overflow-hidden": portalOpen })}
				>
					{breadcrumb ? (
						<div className='border-b'>
							<Container>
								<AppBreadcrumb breadcrumb={breadcrumb} />
							</Container>
						</div>
					) : null}
					<Container className='p-0'>
						<SheetPortal container={portalRef.current}>
							<SheetHeader>
								<SheetTitle className='sr-only'>{trans("Menu")}</SheetTitle>
								<SheetDescription className='sr-only'>{trans("Menu")}</SheetDescription>
							</SheetHeader>
							<UserMenuSheetContent
								authenticated={shared.auth ? true : false}
								registerable={shared.app.registerable}
								onInteractOutside={(event) => event.preventDefault()}
							>
								{shared.auth ? (
									<>
										<SheetClose asChild={true}>
											<NavigationMenuItem
												className={navigationMenuTriggerStyle()}
												asChild={true}
											>
												<a
													href={route("backend.dashboard")}
													target='_blank'
												>
													<ChartPie className='h-5 w-5' />
													{trans("Dashboard")}
												</a>
											</NavigationMenuItem>
										</SheetClose>
										<SheetClose asChild={true}>
											<NavigationMenuItem
												className={navigationMenuTriggerStyle()}
												asChild={true}
											>
												<Link href={route("profile")}>
													<User className='h-5 w-5' />
													{trans("Profile")}
												</Link>
											</NavigationMenuItem>
										</SheetClose>
									</>
								) : null}
							</UserMenuSheetContent>
						</SheetPortal>
						{children}
					</Container>
				</div>

				<AppFooter className='absolute bottom-0 w-full translate-y-full' />
			</Sheet>
		</Layout>
	);
};

export default WebLayout;
