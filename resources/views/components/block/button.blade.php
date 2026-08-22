@if ($link && $link['type'] === 'external')
	<a
		class="bg-primary text-primary-foreground inline-flex items-center justify-center gap-2 rounded-md px-4 py-2 transition-transform duration-200 hover:scale-105"
		data-narsil-node="{{ $nodeId }}"
		href="{{ $link['url'] }}"
		target="_blank"
	>
		{{ $blockData['label'] ?? '' }}
	</a>
@elseif ($link)
	<a
		class="bg-primary text-primary-foreground inline-flex items-center justify-center gap-2 rounded-md px-4 py-2 transition-transform duration-200 hover:scale-105"
		data-narsil-node="{{ $nodeId }}"
		href="{{ $link['page']['url'] }}"
	>
		{{ $blockData['label'] ?? '' }}
	</a>
@else
	<button
		class="bg-primary text-primary-foreground inline-flex items-center justify-center gap-2 rounded-md px-4 py-2"
		data-narsil-node="{{ $nodeId }}"
		type="button"
	>
		{{ $blockData['label'] ?? '' }}
	</button>
@endif
