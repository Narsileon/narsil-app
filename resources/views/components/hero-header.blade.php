<section
	class="{{ $paddingTop }} {{ $paddingBottom }} mx-auto flex w-full max-w-7xl flex-col items-center justify-center gap-4 px-4 text-center"
	data-narsil-node="{{ $nodeId }}"
	style="min-height: calc(100vh - 64px)"
>
	<h1 class="{{ $headlineStyle }} text-foreground font-medium tracking-tight">{{ $blockData['headline']['title'] ?? '' }}
	</h1>
	<div>{!! $blockData['excerpt'] ?? '' !!}</div>
	<div class="flex w-full flex-wrap items-center justify-center gap-4">
		@foreach ($blockData['buttons'] ?? [] as $button)
			<x-block-renderer :block="$button" />
		@endforeach
	</div>
</section>
