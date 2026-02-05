import { VisitOptions } from "@inertiajs/core";
import { cn } from "@narsil-ui/lib/utils";
import { useCallback, type ComponentProps, type SubmitEvent } from "react";
import useForm from "./form-context";

type FormRootProps = ComponentProps<"form"> & {
  options?: Omit<VisitOptions, "data">;
};

function FormRoot({ className, options, ...props }: FormRootProps) {
  const { action, id, post } = useForm();

  const onSubmit = useCallback(
    (event?: SubmitEvent<HTMLFormElement>) => {
      event?.preventDefault();

      const submitOptions: VisitOptions = {
        ...options,
        preserveScroll: options?.preserveScroll,
        preserveState: options?.preserveState,
      };

      post?.(action, submitOptions);
    },
    [action, options, post],
  );

  return (
    <form
      id={id}
      className={cn("grid", className)}
      action={action}
      method="post"
      onSubmit={onSubmit}
      {...props}
    />
  );
}

export default FormRoot;
