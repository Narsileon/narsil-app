import { Container } from "@/blocks";
import { FormProvider, FormRenderer, FormRoot } from "@/components/form";
import { FormType } from "@/types";

type FormProps = {
  form: FormType | FormType[];
};

function Form({ form }: FormProps) {
  if (Array.isArray(form)) {
    form = form[0];
  }

  return (
    <Container variant="sm">
      <FormProvider
        id={form.id}
        action={"action"}
        elements={form.tabs}
        render={() => {
          return (
            <FormRoot
              className="relative w-full animate-in grid-cols-12 items-center gap-4 fade-in-0 md:h-full md:max-h-full md:min-h-full md:overflow-hidden"
              options={{
                preserveState: true,
              }}
            >
              {form.tabs.map((tab, index) => {
                return <FormRenderer {...tab} key={index} />;
              })}
            </FormRoot>
          );
        }}
      />
    </Container>
  );
}

export default Form;
