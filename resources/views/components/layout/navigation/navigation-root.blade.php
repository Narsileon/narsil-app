<x-narsil::ui.navigation-menu.navigation-menu-root
	{{ $attributes->twMerge('bg-layout absolute left-0 right-0 top-full p-4 md:static md:block md:bg-transparent md:p-0')->merge([
	    'data-slot' => 'navigation-root',
	]) }}
	x-bind:class="navigationOpen ? 'block' : 'hidden md:block'"
>
	<x-narsil::ui.navigation-menu.navigation-menu-list
		class="flex-col items-stretch gap-4 font-bold md:flex-row md:items-center lg:gap-8"
	>
		@foreach ($items as $item)
			<x-narsil::ui.navigation-menu.navigation-menu-item>
				<x-narsil::ui.navigation-menu.navigation-menu-link
					:data-active="str_starts_with(request()->url(), $item['url']) ? 'true' : null"
					:href="$item['url']"
				>
					{{ $item['title'] }}
				</x-narsil::ui.navigation-menu.navigation-menu-link>
			</x-narsil::ui.navigation-menu.navigation-menu-item>
		@endforeach
	</x-narsil::ui.navigation-menu.navigation-menu-list>
</x-narsil::ui.navigation-menu.navigation-menu-root>
