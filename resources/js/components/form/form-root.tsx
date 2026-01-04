import { VisitOptions } from "@inertiajs/core";
import { cn } from "@narsil-cms/lib/utils";
import { useCallback, type ComponentProps } from "react";
import useForm from "./form-context";

type FormRootProps = ComponentProps<"form"> & {
  options?: Omit<VisitOptions, "data">;
};

function FormRoot({ className, options, ...props }: FormRootProps) {
  const { action, id, isDirty, post, transform } = useForm();

  const onSubmit = useCallback(
    (event?: React.FormEvent) => {
      event?.preventDefault();

      const submitOptions: VisitOptions = {
        ...options,
        preserveScroll: options?.preserveScroll,
        preserveState: options?.preserveState,
      };

      post?.(action, submitOptions);
    },
    [action, isDirty, options, post, transform],
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
