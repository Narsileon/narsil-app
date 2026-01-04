import { Button, Container } from "@/blocks";
import { FormProvider, FormRenderer, FormRoot } from "@/components/form";
import { FormType } from "@/types";
import { useState } from "react";
import { Fragment } from "react/jsx-runtime";

type FormProps = {
  form: FormType | FormType[];
};

function Form({ form }: FormProps) {
  if (Array.isArray(form)) {
    form = form[0];
  }

  const [success, setSuccess] = useState<boolean>(false);

  return (
    <Container variant="sm">
      {success ? (
        <p>Submitted successfully</p>
      ) : (
        <FormProvider
          id={form.id}
          action={`/forms/${form.id}/submit`}
          elements={form.tabs}
          render={() => {
            return (
              <FormRoot
                className="w-full grid-cols-12 items-center gap-4"
                options={{
                  preserveState: true,
                  onSuccess: () => {
                    setSuccess(true);
                  },
                }}
              >
                {form.tabs.map((tab, index) => {
                  return (
                    <Fragment key={index}>
                      <FormRenderer {...tab} />
                      <Button
                        className="col-span-full justify-self-end"
                        label="Submit"
                        form={form.id}
                        type="submit"
                      />
                    </Fragment>
                  );
                })}
              </FormRoot>
            );
          }}
        />
      )}
    </Container>
  );
}

export default Form;
