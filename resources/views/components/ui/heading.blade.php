@php
	$class = 'font-medium tracking-tight text-foreground ' . match ($variant) {
	    'h1' => 'text-4xl md:text-5xl',
	    'h2' => 'text-3xl md:text-4xl',
	    'h3' => 'text-2xl md:text-3xl',
	    'h4' => 'text-xl md:text-2xl',
	    'h5' => 'text-lg md:text-xl',
	    default => 'text-base md:text-lg',
	};
@endphp

<{{ $level }} data-slot="heading" {{ $attributes->merge(['class' => $class]) }}>
	{{ $slot }}
</{{ $level }}>
