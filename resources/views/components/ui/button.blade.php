@props([
	'variant' => 'primary',
])

@php
	$class = match ($variant) {
		'ghost' => 'text-foreground hover:bg-accent hover:text-accent-foreground',
		default => 'bg-primary text-primary-foreground hover:bg-primary/90',
	};

	$class = "inline-flex items-center justify-center gap-2 rounded-md px-4 py-2 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 $class";
@endphp

<button {{ $attributes->merge(['class' => $class]) }}>
	{{ $slot }}
</button>
