<header
	class="bg-layout text-layout-foreground sticky left-0 right-0 top-0 z-10 flex w-full items-center justify-between px-4 py-2 md:px-4 md:py-4 lg:px-14 xl:px-20"
	x-data="{ navigationOpen: false }"
>
	<a
		class="text-lg font-bold"
		href="{{ url('/') }}"
	>
		NARSIL
	</a>
	<button
		@click="navigationOpen = !navigationOpen"
		aria-label="Toggle navigation"
		class="md:hidden"
		type="button"
	>
		<x-narsil::ui.icon.icon-root
			name="fa-regular-bars"
		/>
	</button>
	<x-narsil::ui.navigation-menu.navigation-menu-root
		class="bg-layout absolute left-0 right-0 top-full p-4 md:static md:block md:bg-transparent md:p-0"
		x-bind:class="navigationOpen ? 'block' : 'hidden md:block'"
	>
		<x-narsil::ui.navigation-menu.navigation-menu-list
			class="flex-col items-stretch gap-4 font-bold md:flex-row md:items-center lg:gap-8"
		>
			@foreach ($navigation[0]['children'] ?? [] as $item)
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
</header>
