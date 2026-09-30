<nav
	{{ $attributes->twMerge('flex gap-4 text-sm') }}
>
	@foreach ($links as $link)
		<a
			class="hover:text-primary/80 transition-colors"
			href="{{ $link['url'] }}"
		>
			{{ $link['label'] }}
		</a>
	@endforeach
</nav>
