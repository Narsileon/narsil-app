import { Button } from "@/blocks/button";
import type { LayoutProps } from "@/types";
import { Container } from "@narsil-ui/components/container";
import { FormElement, FormProvider, FormRoot } from "@narsil-ui/components/form";
import { Heading } from "@narsil-ui/components/heading";
import { useTranslator } from "@narsil-ui/components/translator";
import type { FormData } from "@narsil-ui/types";
import { useState } from "react";

type FormProps = {
  form: FormData;
  layout: LayoutProps;
};

function Form({ form, layout }: FormProps) {
  if (Array.isArray(form)) {
    form = form[0];
  }

  const { trans } = useTranslator();

  const [index, setIndex] = useState<number>(0);
  const [success, setSuccess] = useState<boolean>(false);

  const initialData = {
    _step: 0,
    _uuid: form.id,
  };

  return (
    <Container
      paddingBottom={layout.padding.bottom}
      paddingTop={layout.padding.top}
      variant={layout.size}
    >
      {success ? (
        <p>{trans("ui.submited")}</p>
      ) : (
        <FormProvider
          id={form.id}
          action={`/forms/${form.id}/submit`}
          initialData={initialData}
          steps={form.steps}
          render={({ setData }) => {
            return (
              <FormRoot
                className="w-full grid-cols-12 items-center gap-y-4 sm:gap-x-4 lg:gap-x-8"
                options={{
                  preserveState: true,
                  onSuccess: () => {
                    if (index < form.steps.length - 1) {
                      const nextIndex = index + 1;

                      setData?.("_step", nextIndex);
                      setIndex(nextIndex);
                    } else {
                      setSuccess(true);
                    }
                  },
                }}
              >
                <Heading className="col-span-full text-center" variant="h4">
                  {form.steps[index].label}
                </Heading>
                {form.steps[index]?.elements?.map((element, index) => {
                  return <FormElement {...element} key={index} />;
                })}
                <div className="col-span-full flex flex-row-reverse items-center justify-between">
                  {form.steps.length > 1 && index < form.steps.length - 1 ? (
                    <Button label={trans("ui.next")} form={form.id} type="submit" />
                  ) : (
                    <Button
                      className="col-span-full justify-self-end"
                      label={trans("ui.submit")}
                      form={form.id}
                      type="submit"
                    />
                  )}
                  {index > 0 ? (
                    <Button
                      label={trans("ui.previous")}
                      variant="ghost"
                      onClick={(event) => {
                        event.preventDefault();

                        const previousIndex = index - 1;

                        setData?.("_step", previousIndex);
                        setIndex(previousIndex);
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
