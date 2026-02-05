import { Footer } from "@/blocks/footer";
import { Header } from "@/blocks/header";
import { Main } from "@/blocks/main";
import { GlobalProvider } from "@/providers/global";
import { CSPProvider } from "@base-ui/react/csp-provider";
import { LocalizationProvider } from "@narsil-ui/components/localization";
import { type ReactNode } from "react";

type LayoutProps = {
  children: ReactNode & {
    props: App.Http.Data.GlobalData;
  };
};

function Layout({ children }: LayoutProps) {
  const { footer, navigation, nonce, page, session, translations } = children.props;

  return (
    <CSPProvider nonce={nonce}>
      <LocalizationProvider translations={translations}>
        <GlobalProvider>
          <Header navigation={navigation} />
          <Main>{children}</Main>
          <Footer footer={footer} page={page} session={session} />
        </GlobalProvider>
      </LocalizationProvider>
    </CSPProvider>
  );
}

export default Layout;
