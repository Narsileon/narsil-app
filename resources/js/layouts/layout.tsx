import { Footer, Header } from "@/blocks";
import { GlobalProps } from "@/types";

type LayoutProps = {
  children: React.ReactNode & {
    props: GlobalProps;
  };
};

function Layout({ children }: LayoutProps) {
  const { footer, page, session } = children.props;

  return (
    <div className="flex min-h-svh flex-col">
      <Header />
      <main className="grow bg-gray-950 text-gray-50">{children}</main>
      <Footer footer={footer} page={page} session={session} />
    </div>
  );
}

export default Layout;
