<button
	{{ $attributes->twMerge('md:hidden')->merge([
	    'aria-label' => 'Toggle navigation',
	    'type' => 'button',
	]) }}
	@click="navigationOpen = !navigationOpen"
>
	<x-narsil::ui.icon.icon-root
		name="fa-regular-bars"
	/>
</button>
