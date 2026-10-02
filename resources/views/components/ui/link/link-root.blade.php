<a
	{{ $attributes->twMerge('hover:text-primary transition-colors')->merge([
	    'data-slot' => 'link-root',
	]) }}
	href="{{ $href }}"
>
	{{ $slot }}
</a>
