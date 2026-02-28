import { Button } from "@/blocks/button";
import type { LayoutProps } from "@/types";
import { Container } from "@narsil-ui/components/container";
import { FieldsetLegend, FieldSetRoot } from "@narsil-ui/components/fieldset";
import { FormElement, FormProvider, FormRoot } from "@narsil-ui/components/form";
import { Heading } from "@narsil-ui/components/heading";
import { useTranslator } from "@narsil-ui/components/translator";
import type { FormData } from "@narsil-ui/types";
import { useState } from "react";

type FormProps = {
  form: Omit<App.Http.Data.FormData, "steps"> & {
    steps: FormData["steps"];
  };
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
    _uuid: form.uuid,
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
          id={form.uuid}
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
                  return (
                    <FormElement
                      {...element}
                      render={(fieldset) => {
                        return (
                          <FieldSetRoot className="col-span-full">
                            <FieldsetLegend>{fieldset.label}</FieldsetLegend>
                            <div className="grid grid-cols-12 gap-8 p-4">
                              {fieldset.elements.map((fieldsetElement, index) => {
                                const virtualHandle = `${element.id}.${fieldsetElement.id}`;

                                return (
                                  <FormElement
                                    {...fieldsetElement}
                                    id={virtualHandle}
                                    key={index}
                                  />
                                );
                              })}
                            </div>
                          </FieldSetRoot>
                        );
                      }}
                      key={index}
                    />
                  );
                })}
                <div className="col-span-full flex flex-row-reverse items-center justify-between">
                  {form.steps.length > 1 && index < form.steps.length - 1 ? (
                    <Button label={trans("ui.next")} form={form.uuid} type="submit" />
                  ) : (
                    <Button
                      className="col-span-full justify-self-end"
                      label={trans("ui.submit")}
                      form={form.uuid}
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
