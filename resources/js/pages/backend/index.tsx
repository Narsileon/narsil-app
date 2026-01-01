import { Heading } from "@narsil-cms/blocks";
import { SectionContent, SectionHeader, SectionRoot } from "@narsil-cms/components/section";

function Dashboard() {
  return (
    <SectionRoot className="h-full p-4">
      <SectionHeader>
        <Heading level="h1" variant="h5">
          Welcome to Narsil CMS.
        </Heading>
      </SectionHeader>
      <SectionContent className="flex flex-col gap-4">
        <p>
          This page is an example of how you can override a default CMS view with your own
          implementation.
        </p>
      </SectionContent>
    </SectionRoot>
  );
}

export default Dashboard;
