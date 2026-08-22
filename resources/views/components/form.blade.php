<x-ui.container
	:padding-bottom="$paddingBottom"
	:padding-top="$paddingTop"
	data-narsil-node="{{ $nodeId }}"
	x-data="{
    step: 0,
    submitted: {{ Js::from($submitted) }},
    submitting: false,
    validateStep(stepIndex = this.step, report = true) {
        const stepElement = Array.from(this.$refs.form.querySelectorAll('[data-form-step]')).find((element) => element.dataset.formStep === String(stepIndex));
        const fields = stepElement ? stepElement.querySelectorAll('input, select, textarea') : [];

        for (const field of fields) {
            if (!field.checkValidity()) {
                if (report) {
                    field.reportValidity();
                }

                return false;
            }
        }

        return true;
    },
    handleSubmit(event) {
        event.preventDefault();

        if (this.step < {{ max(count($steps) - 1, 0) }}) {
            if (this.validateStep()) {
                this.step++;
            }

            return;
        }

        for (let stepIndex = 0; stepIndex <= {{ max(count($steps) - 1, 0) }}; stepIndex++) {
            if (!this.validateStep(stepIndex, false)) {
                this.step = stepIndex;
                this.$nextTick(() => this.validateStep(stepIndex));

                return;
            }
        }

        this.submitting = true;

        fetch(event.target.action, {
                body: new FormData(event.target),
                headers: {
                    Accept: 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                method: 'POST',
            })
            .then((response) => {
                if (!response.ok) {
                    throw new Error('The form could not be submitted.');
                }

                this.submitted = true;
            })
            .catch(() => {
                this.submitting = false;
            });
    }
}"
>
	<template
		x-if="submitted"
	>
		<p>
			{{ __('ui.submited') }}
		</p>
	</template>
	<form
		@submit="handleSubmit"
		action="{{ url('/forms/' . ($form['id'] ?? '') . '/submit') }}"
		class="grid w-full grid-cols-12 items-center gap-4"
		method="POST"
		novalidate
		x-ref="form"
		x-show="!submitted"
	>
		@csrf
		<input
			name="_uuid"
			type="hidden"
			value="{{ $form['uuid'] ?? (string) Str::uuid() }}"
		>
		<input
			name="_step"
			type="hidden"
			x-bind:value="step"
		>
		@foreach ($steps as $stepIndex => $stepData)
			<div
				class="col-span-full grid grid-cols-12 gap-4"
				data-form-step="{{ $stepIndex }}"
				x-cloak
				x-show="step === {{ $stepIndex }}"
			>
				<x-ui.heading
					class="col-span-full text-center font-bold"
					level="h2"
					variant="h3"
				>
					{{ $stepData['label'] ?? '' }}
				</x-ui.heading>
				@foreach ($stepData['elements'] ?? [] as $element)
					@if (isset($element['input']))
						<x-form.field
							:field="$element"
						/>
					@else
						<fieldset
							class="col-span-full grid grid-cols-12 gap-4"
						>
							<legend
								class="col-span-full font-bold"
							>
								{{ $element['label'] ?? '' }}
							</legend>
							@foreach ($element['elements'] ?? [] as $fieldsetElement)
								<x-form.field
									:field="$fieldsetElement"
									:name-prefix="$element['id'] ?? null"
								/>
							@endforeach
						</fieldset>
					@endif
				@endforeach
				<div
					class="col-span-full flex flex-row-reverse items-center justify-between"
				>
					@if ($stepIndex < count($steps) - 1)
						<x-ui.button
							type="submit"
						>
							{{ __('narsil::ui.next') }}
						</x-ui.button>
					@else
						<x-ui.button
							type="submit"
							x-bind:disabled="submitting"
						>
							{{ __('ui.submit') }}
						</x-ui.button>
					@endif
					@if ($stepIndex > 0)
						<x-ui.button
							@click="step--"
							type="button"
							variant="ghost"
						>
							{{ __('narsil::ui.previous') }}
						</x-ui.button>
					@endif
				</div>
			</div>
		@endforeach
	</form>
</x-ui.container>
