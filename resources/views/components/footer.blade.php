<footer
	class="bg-layout text-layout-foreground mx-auto flex w-full flex-col gap-6 p-4 md:gap-8 md:px-4 md:pt-6 lg:gap-10 lg:px-14 lg:pt-6 xl:px-20 xl:pt-8"
>
	<div
		class="flex flex-col justify-between gap-6 sm:flex-row"
	>
		<div
			class="flex flex-col gap-6 md:gap-8 lg:gap-10"
		>
			<a
				class="text-lg font-bold"
				href="{{ url('/') }}"
			>
				NARSIL
			</a>
			<div
				class="flex flex-row gap-10"
			>
				<div
					class="flex flex-col gap-0.5 lg:gap-2"
				>
					<p
						class="font-bold"
					>
						{{ $footer['organization'] }}
					</p>
					<p
						class="flex flex-col gap-0.5"
					>
						<span
							class="min-h-6"
						>
							{{ $footer['street'] }}
						</span>
						<span
							class="min-h-6"
						>
							{{ $footer['postal_code'] }}
							{{ $footer['city'] }} - {{ $footer['country'] }}
						</span>
					</p>
				</div>
				<div
					class="flex flex-col justify-end"
				>
					<a
						class="hover:text-primary/80 min-h-6 transition-colors"
						href="mailto:{{ $footer['email'] }}"
					>
						{{ $footer['email'] }}
					</a>
					<a
						class="hover:text-primary/80 min-h-6 transition-colors"
						href="tel:{{ preg_replace('/\s+/', '', $footer['phone'] ?? '') }}"
					>
						{{ $footer['phone'] }}
					</a>
				</div>
			</div>
		</div>
		<div
			class="flex flex-row justify-between gap-6 sm:flex-col-reverse md:gap-8 lg:gap-10"
		>
			<div
				class="flex justify-end gap-6"
			>
				@foreach ($footer['social_media'] as $social)
					<a
						aria-label="{{ $social['label'] }}"
						href="{{ $social['url'] }}"
						target="_blank"
					>
						<x-narsil::ui.icon.icon-root
							:name="$social['icon']"
							class="text-primary hover:text-primary/80 transition-colors"
						/>
					</a>
				@endforeach
			</div>
			<x-narsil::ui.dropdown-menu.dropdown-menu-root>
				<x-narsil::ui.dropdown-menu.dropdown-menu-trigger
					class="hover:bg-background/10 inline-flex items-center gap-2 rounded-md px-2 py-1 font-bold transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-current"
				>
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
	</div>
	<div
		class="flex flex-col flex-wrap items-center gap-2 border-t border-slate-200 pt-4 text-sm text-slate-700 md:flex-row md:justify-between lg:gap-x-8"
	>
		<div>
			©{{ date('Y') }} {{ $footer['organization'] }}. {{ $footer['copyright'] }}
		</div>
		<nav
			class="flex gap-4"
		>
			@foreach ($footer['links'] as $link)
				<a
					class="hover:text-primary/80 transition-colors"
					href="{{ $link['url'] }}"
				>
					{{ $link['label'] }}
				</a>
			@endforeach
		</nav>
	</div>
</footer>
