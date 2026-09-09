@php
	$containerPadding = match (true) {
	    $paddingTop === 'lg' || $paddingBottom === 'lg'
	        => 'pt-16 pb-16 md:pt-24 md:pb-24 lg:pt-32 lg:pb-32 xl:pt-40 xl:pb-40',
	    $paddingTop === 'md' || $paddingBottom === 'md'
	        => 'pt-8 pb-8 md:pt-12 md:pb-12 lg:pt-16 lg:pb-16 xl:pt-20 xl:pb-20',
	    $paddingTop === 'sm' || $paddingBottom === 'sm' => 'pt-4 pb-4 md:pt-6 md:pb-6 lg:pt-8 lg:pb-8 xl:pt-10 xl:pb-10',
	    default => '',
	};
@endphp

<x-narsil::ui.container.container-root
	class="{{ $containerPadding }}"
	data-narsil-node="{{ $nodeId }}"
	x-data="{
    step: 0,
	    submitted: {{ Illuminate\Support\Js::from($submitted) }},
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
			value="{{ $form['uuid'] ?? $uuid }}"
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
				<x-narsil::ui.heading.heading-root
					class="col-span-full text-center font-bold"
					level="h2"
					variant="h3"
				>
					{{ $stepData['label'] ?? '' }}
				</x-narsil::ui.heading.heading-root>
				@foreach ($stepData['elements'] ?? [] as $element)
					@if (isset($element['input']))
						<x-blocks.form.field
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
								<x-blocks.form.field
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
						<x-narsil::ui.button.button-root
							type="submit"
						>
							{{ __('narsil::ui.next') }}
						</x-narsil::ui.button.button-root>
					@else
						<x-narsil::ui.button.button-root
							type="submit"
							x-bind:disabled="submitting"
						>
							{{ __('ui.submit') }}
						</x-narsil::ui.button.button-root>
					@endif
					@if ($stepIndex > 0)
						<x-narsil::ui.button.button-root
							@click="step--"
							type="button"
							variant="ghost"
						>
							{{ __('narsil::ui.previous') }}
						</x-narsil::ui.button.button-root>
					@endif
				</div>
			</div>
		@endforeach
	</form>
</x-narsil::ui.container.container-root>
