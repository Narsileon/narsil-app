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

<x-narsil::ui.container.root
	class="{{ $containerPadding }} flex min-h-[calc(100vh-64px)] flex-col items-center justify-center gap-4 text-center"
	data-narsil-node="{{ $nodeId }}"
>
	<x-narsil::ui.heading.root
		:variant="$blockData['headline']['style'] ?? 'h1'"
		level="h1"
	>
		{{ $blockData['headline']['title'] ?? '' }}
	</x-narsil::ui.heading.root>
	<div>
		{!! $blockData['excerpt'] ?? '' !!}
	</div>
	<div
		class="flex w-full flex-wrap items-center justify-center gap-4"
	>
		@foreach ($blockData['buttons'] ?? [] as $button)
			<x-block-renderer
				:block="$button"
			/>
		@endforeach
	</div>
</x-narsil::ui.container.root>
