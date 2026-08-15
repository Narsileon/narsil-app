@extends('layouts.frontend')

@section('head')
	<title>
		{{ $page['title'] }}</title>
	<meta
		content="{{ $page['meta_description'] ?: $page['title'] }}"
		name="description"
	>
	<meta
		content="{{ $page['open_graph_type'] ?: 'website' }}"
		property="og:type"
	>
	<meta
		content="{{ $page['open_graph_title'] ?: $page['title'] }}"
		property="og:title"
	>
	@if ($page['open_graph_image'])
		<meta
			content="{{ $page['open_graph_image'] }}"
			property="og:image"
		>
	@endif
	@if ($page['open_graph_description'] || $page['meta_description'])
		<meta
			content="{{ $page['open_graph_description'] ?: $page['meta_description'] }}"
			property="og:description"
		>
	@endif
	@if ($footer['organizationSchema'])
		@php
			$organization = [
			    '@context' => 'https://schema.org',
			    '@type' => 'Organization',
			    'name' => $footer['organization'],
			    'url' => $session['url'],
			    'logo' => $session['url'] . '/favicon.svg',
			    'address' => [
			        '@type' => 'PostalAddress',
			        'streetAddress' => $footer['street'],
			        'postalCode' => $footer['postal_code'],
			        'addressLocality' => $footer['city'],
			        'addressCountry' => $footer['country'],
			    ],
			    'contactPoint' => [
			        '@type' => 'ContactPoint',
			        'telephone' => $footer['phone'],
			        'email' => $footer['email'],
			    ],
			    'sameAs' => collect($footer['social_media'])->pluck('url')->all(),
			];
		@endphp
		<script type="application/ld+json">{!! json_encode($organization, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) !!}</script>
	@endif
@endsection

@section('body')
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
			<x-icons.menu />
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
	<main
		class="bg-background text-foreground flex h-fit min-h-svh flex-col items-center justify-center"
	>
		<div
			class="w-full"
		>
			@foreach ($page['data'] ?? [] as $element)
				@if (is_array($element) && array_is_list($element))
					@foreach ($element as $block)
						<x-block-renderer
							:block="$block"
						/>
					@endforeach
				@elseif (is_array($element))
					<x-block-renderer
						:block="$element"
					/>
				@endif
			@endforeach
		</div>
	</main>
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
								:component="'icons.' . $social['icon']"
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
						<x-icons.globe
							class="text-primary"
						/>
						{{ $page['urls'][0]['display_language'] ?? $session['locale'] }}
						<x-icons.chevron-down
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
@endsection
