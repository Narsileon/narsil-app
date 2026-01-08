import { Footer } from "@/blocks/footer";
import { Header } from "@/blocks/header";
import { Main } from "@/blocks/main";
import { GlobalProvider } from "@/providers/global";
import { GlobalProps } from "@/types";

type LayoutProps = {
  children: React.ReactNode & {
    props: GlobalProps;
  };
};

function Layout({ children }: LayoutProps) {
  const { footer, navigation_menu, page, session } = children.props;

  return (
    <GlobalProvider>
      <Header navigation_menu={navigation_menu} />
      <Main>{children}</Main>
      <Footer footer={footer} page={page} session={session} />
    </GlobalProvider>
  );
}

export default Layout;
