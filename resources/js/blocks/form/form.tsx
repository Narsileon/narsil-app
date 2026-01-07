import { Button } from "@/blocks/button";
import { Container } from "@/blocks/container";
import { Heading } from "@/blocks/heading";
import { FormElement, FormProvider, FormRoot } from "@/components/form";
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
          tabs={form.tabs}
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
                <Heading className="col-span-full text-center" variant="h4">
                  {form.tabs[index].label}
                </Heading>
                {form.tabs[index]?.elements?.map((element, index) => {
                  return <FormElement {...element} key={index} />;
                })}
                <div className="col-span-full flex flex-row-reverse items-center justify-between">
                  {form.tabs.length > 1 && index < form.tabs.length - 1 ? (
                    <Button
                      label="Next"
                      onClick={(event) => {
                        event.preventDefault();
                        setIndex(index + 1);
                      }}
                    />
                  ) : (
                    <Button
                      className="col-span-full justify-self-end"
                      label="Submit"
                      form={form.slug}
                      type="submit"
                    />
                  )}
                  {index > 0 ? (
                    <Button
                      label="Previous"
                      variant="ghost"
                      onClick={(event) => {
                        event.preventDefault();
                        setIndex(index - 1);
                      }}
                    />
                  ) : null}
                </div>
              </FormRoot>
            );
          }}
        />
      )}
    </Container>
  );
}

export default Form;
