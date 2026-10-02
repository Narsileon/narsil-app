@if ($link && $link['type'] === 'external')
	<a
		{{ $attributes->twMerge(
		        'bg-primary text-primary-foreground inline-flex items-center justify-center gap-2 rounded-md px-4 py-2 transition-transform duration-200 hover:scale-105',
		    )->merge([
		        'data-slot' => 'button-root',
		    ]) }}
		data-narsil-node="{{ $nodeId }}"
		href="{{ $link['url'] }}"
		target="_blank"
	>
		{{ $contentData['label'] ?? '' }}
	</a>
@elseif ($link)
	<a
		{{ $attributes->twMerge(
		        'bg-primary text-primary-foreground inline-flex items-center justify-center gap-2 rounded-md px-4 py-2 transition-transform duration-200 hover:scale-105',
		    )->merge([
		        'data-slot' => 'button-root',
		    ]) }}
		data-narsil-node="{{ $nodeId }}"
		href="{{ $link['page']['url'] }}"
	>
		{{ $contentData['label'] ?? '' }}
	</a>
@else
	<button
		{{ $attributes->twMerge('bg-primary text-primary-foreground inline-flex items-center justify-center gap-2 rounded-md px-4 py-2')->merge([
		        'data-slot' => 'button-root',
		    ]) }}
		data-narsil-node="{{ $nodeId }}"
		type="button"
	>
		{{ $contentData['label'] ?? '' }}
	</button>
@endif
