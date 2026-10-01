<a
	{{ $attributes->twMerge('inline-flex text-primary transition-colors hover:text-primary/80 [&_svg]:size-7 [&_svg]:text-current')->merge([
	    'data-slot' => 'social-media-root',
	]) }}
	aria-label="{{ $label }}"
	href="{{ $url }}"
	target="_blank"
	rel="noopener noreferrer"
>
	{{ $slot }}
</a>
