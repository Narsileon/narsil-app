<a
	{{ $attributes->twMerge('hover:text-primary/80 transition-colors')->merge([
	    'data-slot' => 'link-root',
	]) }}
	href="{{ $href }}"
>
	{{ $slot }}
</a>
