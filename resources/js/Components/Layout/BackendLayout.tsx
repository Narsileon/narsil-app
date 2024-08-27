import { GlobalProps } from "@/Types";
import { Link, usePage } from "@inertiajs/react";
import { Menu, X } from "lucide-react";
import { useTranslationsStore } from "@narsil-localization/Stores/translationStore";
import AppLanguage from "@narsil-localization/Components/App/AppLanguage";
import Avatar from "@narsil-ui/Components/Avatar/Avatar";
import AvatarFallback from "@narsil-ui/Components/Avatar/AvatarFallback";
import Button from "@narsil-ui/Components/Button/Button";
import DropdownMenu from "@narsil-ui/Components/DropdownMenu/DropdownMenu";
import DropdownMenuTrigger from "@narsil-ui/Components/DropdownMenu/DropdownMenuTrigger";
import Layout from "@narsil-ui/Components/Layout/Layout";
import React from "react";
import ScrollArea from "@narsil-ui/Components/ScrollArea/ScrollArea";
import Sheet from "@narsil-ui/Components/Sheet/Sheet";
import SheetContent from "@narsil-ui/Components/Sheet/SheetContent";
import SheetPortal from "@narsil-ui/Components/Sheet/SheetPortal";
import SheetTrigger from "@narsil-ui/Components/Sheet/SheetTrigger";
import ThemeController from "@narsil-ui/Components/Themes/ThemeController";
import TooltipWrapper from "@narsil-ui/Components/Tooltip/TooltipWrapper";
import UserMenuDropdownContent from "@narsil-auth/Components/UserMenu/UserMenuDropdownContent";
import useScreenStore from "@narsil-ui/Stores/screenStore";

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
				open={portalOpen}
				onOpenChange={setPortalOpen}
			>
				<header className='flex items-center justify-between bg-primary px-4 py-2 text-primary-foreground'>
					<div className='flex items-center gap-x-4'>
						{isMobile ? (
							<SheetTrigger>
								{portalOpen ? <X className='h-6 w-6' /> : <Menu className='h-6 w-6' />}
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
											<AvatarFallback className='text-primary'>JR</AvatarFallback>
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
							className='absolute inset-0 w-full'
							side='left'
						></SheetContent>
					</SheetPortal>
					<aside className='hidden h-full min-w-fit items-start overflow-y-auto border-r bg-background p-1 sm:block'>
						<ScrollArea className='gap-y-1'></ScrollArea>
					</aside>

					<ScrollArea className='h-full grow'>
						<div className='w-full'>{children}</div>
					</ScrollArea>
				</div>
			</Sheet>
		</Layout>
	);
};

export default BackendLayout;
