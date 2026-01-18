import { Button } from "@/blocks/button";
import { Container } from "@/blocks/container";
import { Heading } from "@/blocks/heading";
import { FormElement, FormProvider, FormRoot } from "@/components/form";
import { LayoutProps } from "@/types";
import { useLocalization } from "@narsil-cms/components/localization";
import { useState } from "react";

type FormProps = {
  form: App.Http.Data.FormData | App.Http.Data.FormData[];
  layout: LayoutProps;
};

function Form({ form, layout }: FormProps) {
  if (Array.isArray(form)) {
    form = form[0];
  }

  const { trans } = useLocalization();

  const [index, setIndex] = useState<number>(0);
  const [success, setSuccess] = useState<boolean>(false);

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
          id={form.slug}
          action={`/forms/${form.id}/submit`}
          steps={form.steps}
          initialValues={{
            _step: 0,
            _uuid: form.uuid,
          }}
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
                    <Button label={trans("ui.next")} form={form.slug} type="submit" />
                  ) : (
                    <Button
                      className="col-span-full justify-self-end"
                      label={trans("ui.submit")}
                      form={form.slug}
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
