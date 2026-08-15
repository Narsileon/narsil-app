@php
	$headlineStyle = match ($blockData['headline']['style'] ?? 'h1') {
	    'h1' => 'text-4xl md:text-5xl',
	    'h2' => 'text-3xl md:text-4xl',
	    'h3' => 'text-2xl md:text-3xl',
	    'h4' => 'text-xl md:text-2xl',
	    'h5' => 'text-lg md:text-xl',
	    'h6' => 'text-base md:text-lg',
	    default => 'text-4xl md:text-5xl',
	};
@endphp

<x-ui.container
	:padding-bottom="$paddingBottom"
	:padding-top="$paddingTop"
	class="flex min-h-[calc(100vh-64px)] flex-col items-center justify-center gap-4 text-center"
	data-narsil-node="{{ $nodeId }}"
>
	<h1
		class="{{ $headlineStyle }} text-foreground font-medium tracking-tight"
	>
		{{ $blockData['headline']['title'] ?? '' }}
	</h1>
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
</x-ui.container>
