import { cn } from "@narsil-ui/Components";
import { Home, Star } from "lucide-react";
import { Link, router, usePage } from "@inertiajs/react";
import { navigationMenuTriggerStyle } from "@narsil-ui/Components/NavigationMenu/NavigationMenuTrigger";
import { upperFirst } from "lodash";
import { useState } from "react";
import { useTranslationsStore } from "@narsil-localization/Stores/translationStore";
import AppLanguage from "@narsil-localization/Components/App/AppLanguage";
import Button from "@narsil-ui/Components/Button/Button";
import Collapsible from "@narsil-ui/Components/Collapsible/Collapsible";
import CollapsibleContent from "@narsil-ui/Components/Collapsible/CollapsibleContent";
import CollapsibleTrigger from "@narsil-ui/Components/Collapsible/CollapsibleTrigger";
import Layout from "@narsil-ui/Components/Layout/Layout";
import NavigationMenu from "@narsil-ui/Components/NavigationMenu/NavigationMenu";
import NavigationMenuItem from "@narsil-ui/Components/NavigationMenu/NavigationMenuItem";
import NavigationMenuLink from "@narsil-ui/Components/NavigationMenu/NavigationMenuLink";
import NavigationMenuList from "@narsil-ui/Components/NavigationMenu/NavigationMenuList";
import React from "react";
import ScrollArea from "@narsil-ui/Components/ScrollArea/ScrollArea";
import Svg from "@narsil-ui/Components/Svg/Svg";
import ThemeController from "@narsil-ui/Components/Themes/ThemeController";
import TooltipWrapper from "@narsil-ui/Components/Tooltip/TooltipWrapper";
import useScreenStore from "@narsil-ui/Stores/screenStore";

interface Props {
	children?: React.ReactNode;
}

const BackendLayout = ({ children }: Props) => {
	const { trans } = useTranslationsStore();

	const { isMobile } = useScreenStore();

	const shared = usePage<GlobalProps>().props.shared;

	const localization = shared.localization;

	const backendMenu = shared.menus.backendMenu;
	const headerMenu = shared.menus.headerMenu;
	const favorites = shared.menus.favorites;

	const [pinned, setPinned] = useState(false);
	const [visible, setVisible] = useState(false);

	const Header = (
		<header className='p-default border-b py-2'>
			<FlexWrapper>
				<FlexWrapper
					className='sm:space-x-0'
					width='w-fit'
				>
					<Button
						className='sm:hidden'
						icon={visible ? "fas fa-x" : "fas fa-bars"}
						onClick={() => {
							setVisible(!visible);
						}}
					/>

					<FlexWrapper
						justify='start'
						width='w-fit'
					>
						<AppLogo />

						<TooltipWrapper tooltip={trans("tooltips.back_to_your_homepage")}>
							<Button
								onClick={() => router.get(route("start"))}
								size='icon'
								variant='ghost'
							>
								<Home />
							</Button>
						</TooltipWrapper>
					</FlexWrapper>
				</FlexWrapper>

				<HorizontalMenu menu={headerMenu} />

				<FlexWrapper
					className='space-x-4'
					justify='end'
					width='w-fit'
				>
					<AppNotifications />
					<AppLanguage
						languages={localization.languages}
						locale={localization.locale}
					/>
					<ThemeController />
					<UserMenu />
				</FlexWrapper>
			</FlexWrapper>
		</header>
	);

	return (
		<Layout>
			{Header}

			<div
				className={cn("relative w-full grow overflow-auto", {
					flex: pinned,
				})}
			>
				<AsideMenu
					className={cn({ relative: pinned })}
					maxWidth={isMobile ? undefined : "500px"}
					minWidth={isMobile ? undefined : "52px"}
					onMouseEnter={isMobile || visible ? undefined : () => setVisible(true)}
					onMouseLeave={isMobile || pinned ? undefined : () => setVisible(false)}
					pinned={pinned}
					setPinned={setPinned}
					visible={visible}
				>
					<NavigationMenu orientation='vertical'>
						<NavigationMenuList>
							<ScrollArea>
								<NavigationMenuItem>
									<Collapsible>
										<CollapsibleTrigger>
											<Star className='h-5 w-5' />
											{trans("common.favorites")}
										</CollapsibleTrigger>

										<CollapsibleContent>
											{backendMenu
												.filter((x) => favorites.includes(x.menu_node.id))
												.map((node, index) => {
													return (
														<NavigationMenuItem key={index}>
															<Link href={node.menu_node.url}>
																<NavigationMenuLink
																	className={navigationMenuTriggerStyle()}
																>
																	{upperFirst(node.menu_node.label)}
																</NavigationMenuLink>
															</Link>
														</NavigationMenuItem>
													);
												})}
										</CollapsibleContent>
									</Collapsible>
								</NavigationMenuItem>
								<NavigationMenuItem>
									<NavigationMenuLink
										className={cn(navigationMenuTriggerStyle())}
										asChild={true}
									>
										<Link href={route("backend.index")}>
											<Svg src={`/storage/icons/lucide/pie-chart.svg`} />
											{trans("common.backend")}
										</Link>
									</NavigationMenuLink>
								</NavigationMenuItem>

								{renderMenuNodes(backendMenu?.filter((x) => x.parent_id === null))}
							</ScrollArea>
						</NavigationMenuList>
					</NavigationMenu>
				</AsideMenu>

				<ScrollArea
					className='h-full'
					style={
						!isMobile && !pinned
							? {
									paddingLeft: "52px",
								}
							: undefined
					}
				>
					{children}
				</ScrollArea>
			</div>

			<footer className='p-default border-t py-2'>
				<AppFooter />
			</footer>
		</Layout>
	);
};

export default BackendLayout;
