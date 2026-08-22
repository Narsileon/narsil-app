<x-ui.container
	:padding-bottom="$paddingBottom"
	:padding-top="$paddingTop"
	class="flex min-h-[calc(100vh-64px)] flex-col items-center justify-center gap-4 text-center"
	data-narsil-node="{{ $nodeId }}"
>
	<x-ui.heading
		level="h1"
		:variant="$blockData['headline']['style'] ?? 'h1'"
	>
		{{ $blockData['headline']['title'] ?? '' }}
	</x-ui.heading>
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
