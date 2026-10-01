<div
	{{ $attributes->twMerge('text-sm')->merge([
	    'data-slot' => 'copyright-root',
	]) }}
>
	©{{ date('Y') }} {{ $organization }}. {{ $copyright }}
</div>
