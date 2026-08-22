<header
	class="bg-layout text-layout-foreground sticky left-0 right-0 top-0 z-10 flex w-full items-center justify-between px-4 py-2 md:px-4 md:py-4 lg:px-14 xl:px-20"
	x-data="{ open: false }"
>
	<a
		class="text-lg font-bold"
		href="{{ url('/') }}"
	>
		NARSIL
	</a>
	<button
		@click="open = !open"
		aria-label="Toggle navigation"
		class="md:hidden"
		type="button"
	>
		<x-icon.menu />
	</button>
	<nav
		:class="open ? 'block' : 'hidden md:block'"
		class="bg-layout absolute left-0 right-0 top-full p-4 md:static md:block md:bg-transparent md:p-0"
	>
		<ul
			class="flex flex-col gap-4 font-bold md:flex-row lg:gap-8"
		>
			@foreach ($navigation[0]['children'] ?? [] as $item)
				<li>
					<a
						class="{{ str_starts_with($session['url'], $item['url']) ? 'underline' : '' }}"
						href="{{ $item['url'] }}"
					>
						{{ $item['title'] }}
					</a>
				</li>
			@endforeach
		</ul>
	</nav>
</header>
