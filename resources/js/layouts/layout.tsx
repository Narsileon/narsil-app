import { Footer } from "@/blocks/footer";
import { Header } from "@/blocks/header";
import { Main } from "@/blocks/main";
import { GlobalProvider } from "@/providers/global";
import { LocalizationProvider } from "@narsil-cms/components/localization";

type LayoutProps = {
  children: React.ReactNode & {
    props: App.Http.Data.GlobalData;
  };
};

function Layout({ children }: LayoutProps) {
  const { footer, navigation, page, session, translations } = children.props;

  return (
    <LocalizationProvider translations={translations}>
      <GlobalProvider>
        <Header navigation={navigation} />
        <Main>{children}</Main>
        <Footer footer={footer} page={page} session={session} />
      </GlobalProvider>
    </LocalizationProvider>
  );
}

export default Layout;
