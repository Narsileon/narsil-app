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
						class="min-h-6"
						href="mailto:{{ $footer['email'] }}"
					>
						{{ $footer['email'] }}
					</a>
					<a
						class="min-h-6"
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
						<x-dynamic-component
							:component="'icon.' . $social['icon']"
							class="text-primary hover:text-primary/80 transition-colors"
						/>
					</a>
				@endforeach
			</div>
			<div
				class="relative"
				x-data="{ open: false }"
			>
				<button
					:aria-expanded="open"
					@click="open = !open"
					aria-haspopup="menu"
					class="hover:bg-background/10 inline-flex items-center gap-2 rounded-md px-2 py-1 font-bold transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-current"
					type="button"
				>
					<x-icon.globe
						class="text-primary"
					/>
					{{ $page['urls'][0]['display_language'] ?? $session['locale'] }}
					<x-icon.chevron-down
						:class="open ? 'rotate-180' : ''"
						class="text-primary transition-transform"
					/>
				</button>
				<div
					@click.outside="open = false"
					@keydown.escape.window="open = false"
					class="border-border bg-popover text-popover-foreground absolute right-0 z-20 mt-2 min-w-40 overflow-hidden rounded-md border p-1 shadow-lg ring-1 ring-black/5"
					role="menu"
					x-cloak
					x-show="open"
					x-transition.origin.top.right
				>
					@foreach ($page['urls'] as $url)
						<a
							class="hover:bg-accent hover:text-accent-foreground focus:bg-accent block rounded-sm px-3 py-2 text-sm transition-colors focus:outline-none"
							href="{{ $url['url'] }}"
							role="menuitem"
						>
							{{ $url['display_language'] }}
						</a>
					@endforeach
				</div>
			</div>
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
					href="{{ $link['url'] }}"
				>
					{{ $link['label'] }}
				</a>
			@endforeach
		</nav>
	</div>
</footer>
