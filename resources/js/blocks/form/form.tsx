import { Button } from "@/blocks/button";
import { Container } from "@/blocks/container";
import { FormProvider, FormRenderer, FormRoot } from "@/components/form";
import { useState } from "react";

type FormProps = {
  form: App.Http.Data.FormData | App.Http.Data.FormData[];
};

function Form({ form }: FormProps) {
  if (Array.isArray(form)) {
    form = form[0];
  }

  const [index, setIndex] = useState<number>(0);
  const [success, setSuccess] = useState<boolean>(false);

  return (
    <Container variant="sm">
      {success ? (
        <p>Submitted successfully</p>
      ) : (
        <FormProvider
          id={form.slug}
          action={`/forms/${form.id}/submit`}
          elements={form.tabs}
          render={() => {
            return (
              <FormRoot
                className="w-full grid-cols-12 items-center gap-x-8 gap-y-4"
                options={{
                  preserveState: true,
                  onSuccess: () => {
                    setSuccess(true);
                  },
                }}
              >
                <FormRenderer {...form.tabs[index]} />
                <Button
                  className="col-span-full justify-self-end"
                  label="Submit"
                  form={form.slug}
                  type="submit"
                />
              </FormRoot>
            );
          }}
        />
      )}
    </Container>
  );
}

export default Form;
