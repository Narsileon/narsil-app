import { Footer } from "@/blocks/footer";
import { Header } from "@/blocks/header";
import { Main } from "@/blocks/main";
import { GlobalProvider } from "@/providers/global";
import { CSPProvider } from "@base-ui/react/csp-provider";
import { initPreviewBridge } from "@narsil-cms/live-editor/core/preview-bridge";
import { TranslatorProvider } from "@narsil-ui/components/translator";
import { useEffect, type ReactNode } from "react";

type LayoutProps = {
  children: ReactNode & {
    props: App.Http.Data.GlobalData;
  };
};

function Layout({ children }: LayoutProps) {
  const { editorMode, footer, navigation, nonce, page, session, translations } = children.props;

  useEffect(() => {
    if (!editorMode) {
      return;
    }

    return initPreviewBridge();
  }, [editorMode]);

  return (
    <CSPProvider nonce={nonce}>
      <TranslatorProvider locale={session.locale} translations={translations}>
        <GlobalProvider>
          <Header navigation={navigation} session={session} />
          <Main>{children}</Main>
          <Footer footer={footer} page={page} session={session} />
        </GlobalProvider>
      </TranslatorProvider>
    </CSPProvider>
  );
}

export default Layout;
