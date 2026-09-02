@php
	$isToggle = in_array($fieldType, ['checkbox', 'switch'], true);
	$fieldClasses = $isToggle
	    ? 'flex-row-reverse items-center justify-end gap-2'
	    : 'flex-col gap-2';
@endphp

<label
	class="md:col-span-{{ max(1, min(12, (int) (($fieldData['width'] ?? 100) / 8.333))) }} col-span-full flex {{ $fieldClasses }} {{ $fieldData['className'] ?? '' }}"
>
	<x-narsil::blocks.label.root
		:required="$fieldData['required'] ?? false"
	>
		{{ $fieldData['label'] ?? $fieldName }}
	</x-narsil::blocks.label.root>
	@if ($fieldType === 'textarea' || $fieldType === 'rich-text')
		<textarea
		 @required($fieldData['required'] ?? false)
		 class="border-border bg-background text-foreground rounded-md border p-2"
		 name="{{ $fieldName }}"
		 placeholder="{{ $fieldInput['placeholder'] ?? '' }}"
		>
    {{ $fieldInput['defaultValue'] ?? '' }}
    </textarea>
	@elseif ($fieldType === 'select')
		<select
			@required($fieldData['required'] ?? false)
			class="border-border bg-background text-foreground rounded-md border p-2"
			name="{{ $fieldName }}"
		>
			<option
				value=""
			>
				{{ $fieldInput['placeholder'] ?? '' }}
			</option>
			@foreach ($fieldOptions as $option)
				<option
					value="{{ $option['value'] ?? '' }}"
				>
					{{ $option['label'] ?? '' }}
				</option>
			@endforeach
		</select>
	@elseif (in_array($fieldType, ['checkbox', 'switch'], true))
		<input
			@checked($fieldInput['defaultValue'] ?? false)
			name="{{ $fieldName }}"
			type="checkbox"
			value="1"
		>
	@else
		<input
			@required($fieldData['required'] ?? false)
			class="border-border bg-background text-foreground rounded-md border p-2"
			name="{{ $fieldName }}"
			type="{{ $htmlType }}"
			value="{{ $fieldInput['defaultValue'] ?? '' }}"
		>
	@endif
</label>
