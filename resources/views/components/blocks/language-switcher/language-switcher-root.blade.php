<div
	{{ $attributes->twMerge('inline-flex')->merge([
	    'data-slot' => 'language-switcher-root',
	]) }}
>
	<x-narsil::ui.dropdown-menu.dropdown-menu-root>
		<x-narsil::ui.dropdown-menu.dropdown-menu-trigger>
			<x-narsil::ui.icon.icon-root
				class="text-primary"
				name="fa-solid-globe"
			/>
			{{ $page['urls'][0]['display_language'] ?? $session['locale'] }}
			<x-narsil::ui.icon.icon-root
				class="text-primary size-4 transition-transform"
				name="fa-regular-chevron-down"
				x-bind:class="dropdownOpen ? 'rotate-180' : ''"
			/>
		</x-narsil::ui.dropdown-menu.dropdown-menu-trigger>
		<x-narsil::ui.dropdown-menu.dropdown-menu-positioner
			align="end"
		>
			<x-narsil::ui.dropdown-menu.dropdown-menu-popup>
				@foreach ($page['urls'] as $url)
					<x-narsil::ui.dropdown-menu.dropdown-menu-item
						:href="$url['url']"
					>
						{{ $url['display_language'] }}
					</x-narsil::ui.dropdown-menu.dropdown-menu-item>
				@endforeach
			</x-narsil::ui.dropdown-menu.dropdown-menu-popup>
		</x-narsil::ui.dropdown-menu.dropdown-menu-positioner>
	</x-narsil::ui.dropdown-menu.dropdown-menu-root>
</div>
