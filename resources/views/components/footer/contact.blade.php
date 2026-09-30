<div {{ $attributes->twMerge('flex flex-col justify-end') }}>
	<a
		class="hover:text-primary/80 min-h-6 transition-colors"
		href="mailto:{{ $email }}"
	>
		{{ $email }}
	</a>
	<a
		class="hover:text-primary/80 min-h-6 transition-colors"
		href="tel:{{ preg_replace('/\s+/', '', $phone ?? '') }}"
	>
		{{ $phone }}
	</a>
</div>
