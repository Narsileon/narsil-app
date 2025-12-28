import { Footer, Header } from "@/blocks";
import { GlobalProps } from "@/types";

type LayoutProps = {
  children: React.ReactNode & {
    props: GlobalProps;
  };
};

function Layout({ children }: LayoutProps) {
  const { footer, navigation_menu, page, session } = children.props;

  return (
    <div className="flex min-h-svh flex-col">
      <Header navigation_menu={navigation_menu} />
      <main className="grow bg-secondary text-secondary-foreground">{children}</main>
      <Footer footer={footer} page={page} session={session} />
    </div>
  );
}

export default Layout;
