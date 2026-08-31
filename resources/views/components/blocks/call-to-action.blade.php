@php
	$containerPadding = match (true) {
	    $paddingTop === 'lg' || $paddingBottom === 'lg'
	        => 'pt-16 pb-16 md:pt-24 md:pb-24 lg:pt-32 lg:pb-32 xl:pt-40 xl:pb-40',
	    $paddingTop === 'md' || $paddingBottom === 'md'
	        => 'pt-8 pb-8 md:pt-12 md:pb-12 lg:pt-16 lg:pb-16 xl:pt-20 xl:pb-20',
	    $paddingTop === 'sm' || $paddingBottom === 'sm' => 'pt-4 pb-4 md:pt-6 md:pb-6 lg:pt-8 lg:pb-8 xl:pt-10 xl:pb-10',
	    default => '',
	};
@endphp

<x-narsil::ui.container.root
	class="{{ $containerPadding }} flex justify-center"
	data-narsil-node="{{ $nodeId }}"
>
	<x-blocks.button
		:data="$data"
		:node-id="$nodeId"
	/>
</x-narsil::ui.container.root>
