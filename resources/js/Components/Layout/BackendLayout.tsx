import { cn } from "@narsil-ui/Components";
import { GlobalProps } from "@/Types";
import { Link, usePage } from "@inertiajs/react";
import { Menu, PieChart, Star, X } from "lucide-react";
import { navigationMenuTriggerStyle } from "@narsil-ui/Components/NavigationMenu/NavigationMenuTrigger";
import { useTranslationsStore } from "@narsil-localization/Stores/translationStore";
import AppLanguage from "@narsil-localization/Components/App/AppLanguage";
import Avatar from "@narsil-ui/Components/Avatar/Avatar";
import AvatarFallback from "@narsil-ui/Components/Avatar/AvatarFallback";
import Button from "@narsil-ui/Components/Button/Button";
import Collapsible from "@narsil-ui/Components/Collapsible/Collapsible";
import CollapsibleContent from "@narsil-ui/Components/Collapsible/CollapsibleContent";
import CollapsibleTrigger from "@narsil-ui/Components/Collapsible/CollapsibleTrigger";
import DropdownMenu from "@narsil-ui/Components/DropdownMenu/DropdownMenu";
import DropdownMenuTrigger from "@narsil-ui/Components/DropdownMenu/DropdownMenuTrigger";
import Layout from "@narsil-ui/Components/Layout/Layout";
import NavigationMenu from "@narsil-ui/Components/NavigationMenu/NavigationMenu";
import NavigationMenuAsideRenderer from "@narsil-menus/Components/NavigationMenu/NavigationMenuAsideRenderer";
import NavigationMenuItem from "@narsil-ui/Components/NavigationMenu/NavigationMenuItem";
import NavigationMenuLink from "@narsil-ui/Components/NavigationMenu/NavigationMenuLink";
import NavigationMenuList from "@narsil-ui/Components/NavigationMenu/NavigationMenuList";
import React from "react";
import ScrollArea from "@narsil-ui/Components/ScrollArea/ScrollArea";
import Sheet from "@narsil-ui/Components/Sheet/Sheet";
import SheetClose from "@narsil-ui/Components/Sheet/SheetClose";
import SheetContent from "@narsil-ui/Components/Sheet/SheetContent";
import SheetPortal from "@narsil-ui/Components/Sheet/SheetPortal";
import SheetTrigger from "@narsil-ui/Components/Sheet/SheetTrigger";
import ThemeController from "@narsil-ui/Components/Themes/ThemeController";
import TooltipWrapper from "@narsil-ui/Components/Tooltip/TooltipWrapper";
import UserMenuDropdownContent from "@narsil-auth/Components/UserMenu/UserMenuDropdownContent";
import useScreenStore from "@narsil-ui/Stores/screenStore";
import SheetTitle from "@narsil-ui/Components/Sheet/SheetTitle";
import SheetHeader from "@narsil-ui/Components/Sheet/SheetHeader";
import SheetDescription from "@narsil-ui/Components/Sheet/SheetDescription";

interface Props {
	children?: React.ReactNode;
}

const BackendLayout = ({ children }: Props) => {
	const { trans } = useTranslationsStore();

	const { isMobile } = useScreenStore();

	const shared = usePage<GlobalProps>().props.shared;

	const portal = React.useRef(null);

	const [portalOpen, setPortalOpen] = React.useState<boolean>(false);

	return (
		<Layout className='h-screen max-h-screen'>
			<Sheet
				open={!isMobile || portalOpen}
				onOpenChange={setPortalOpen}
				modal={false}
			>
				<header className='flex items-center justify-between bg-primary px-4 py-2 text-primary-foreground'>
					<div className='flex items-center gap-x-4'>
						{isMobile ? (
							<SheetTrigger>
								{portalOpen ? <X className='h-6 w-6' /> : <Menu className='h-6 w-6' />}
								<span className='sr-only'>{trans(portalOpen ? "Close" : "Menu")}</span>
							</SheetTrigger>
						) : null}
						<div className='flex items-center place-self-start self-center'>
							<Link
								className='flex items-center gap-2 text-2xl font-bold'
								href={route("home")}
							>
								NARSIL
							</Link>
						</div>
					</div>

					<div className='right-4 flex items-center justify-end'>
						<AppLanguage languages={shared.localization.languages} />
						<ThemeController />
						<DropdownMenu>
							<TooltipWrapper tooltip={trans("common.menu")}>
								<DropdownMenuTrigger
									className='ml-2'
									asChild={true}
								>
									<Button size='icon'>
										<Avatar>
											<AvatarFallback className='bg-white text-primary'>JR</AvatarFallback>
										</Avatar>
									</Button>
								</DropdownMenuTrigger>
							</TooltipWrapper>
							<UserMenuDropdownContent authenticated={true} />
						</DropdownMenu>
					</div>
				</header>

				<div
					ref={portal}
					className='relative flex w-full grow flex-row overflow-hidden'
				>
					<SheetPortal container={portal.current}>
						<SheetContent
							className='absolute inset-0 w-full p-1 sm:w-14 hover:sm:w-fit'
							side='left'
						>
							<SheetHeader>
								<SheetTitle className='sr-only'>{trans("Menu")}</SheetTitle>
								<SheetDescription className='sr-only'>{trans("Menu")}</SheetDescription>
							</SheetHeader>

							<aside>
								<ScrollArea>
									<NavigationMenu orientation='vertical'>
										<NavigationMenuList>
											{!isMobile ? (
												<Collapsible>
													<CollapsibleTrigger>
														<Star className='h-5 w-5' />
														{trans("Favorites")}
													</CollapsibleTrigger>

													<CollapsibleContent></CollapsibleContent>
												</Collapsible>
											) : null}
											<SheetClose asChild={true}>
												<NavigationMenuItem
													className={cn(navigationMenuTriggerStyle())}
													asChild={true}
												>
													<NavigationMenuLink
														active={route().current() === "backend.dashboard"}
														asChild={true}
													>
														<Link href={route("backend.dashboard")}>
															<PieChart className='h-5 w-5' />
															{trans("Dashboard")}
														</Link>
													</NavigationMenuLink>
												</NavigationMenuItem>
											</SheetClose>
											{<NavigationMenuAsideRenderer nodes={shared.menus.backend.data} />}
										</NavigationMenuList>
									</NavigationMenu>
								</ScrollArea>
							</aside>
						</SheetContent>
					</SheetPortal>

					<ScrollArea className='h-full grow sm:pl-14'>
						<div className='w-full'>{children}</div>
					</ScrollArea>
				</div>
			</Sheet>
		</Layout>
	);
};

export default BackendLayout;
