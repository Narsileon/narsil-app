@props([
    'paddingBottom' => null,
    'paddingTop' => null,
])

@php
	$paddingBottomClass = match ($paddingBottom) {
	    'sm' => 'pb-4 md:pb-6 lg:pb-8 xl:pb-10',
	    'md' => 'pb-8 md:pb-12 lg:pb-16 xl:pb-20',
	    'lg' => 'pb-16 md:pb-24 lg:pb-32 xl:pb-40',
	    default => '',
	};
	$paddingTopClass = match ($paddingTop) {
	    'sm' => 'pt-4 md:pt-6 lg:pt-8 xl:pt-10',
	    'md' => 'pt-8 md:pt-12 lg:pt-16 xl:pt-20',
	    'lg' => 'pt-16 md:pt-24 lg:pt-32 xl:pt-40',
	    default => '',
	};

	$class = "$paddingBottomClass $paddingTopClass mx-auto w-full max-w-7xl px-4";
@endphp

<section
	{{ $attributes->merge(['class' => $class]) }}
	data-slot="container"
>
	{{ $slot }}
</section>
