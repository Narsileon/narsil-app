@extends('layouts.frontend')

@section('head')
	<title>
		{{ $page['title'] }}
	</title>
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
	@if ($footer['organization_schema'])
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
	<x-header.root>
		<x-ui.brand.root />
		<x-header.navigation-toggle />
		<x-header.navigation
			:items="$navigation[0]['children'] ?? []"
		/>
	</x-header.root>
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
	<x-footer.root>
		<div
			class="flex flex-col justify-between gap-6 sm:flex-row"
		>
			<div
				class="flex flex-col gap-6 md:gap-8 lg:gap-10"
			>
				<x-ui.brand.root />
				<div
					class="flex flex-row gap-10"
				>
					<div
						class="flex flex-col gap-0.5 lg:gap-2"
					>
						<x-footer.organization
							:organization="$footer['organization']"
						/>
						<x-footer.address
							:city="$footer['city']"
							:country="$footer['country']"
							:postal-code="$footer['postal_code']"
							:street="$footer['street']"
						/>
					</div>
					<x-footer.contact
						:email="$footer['email']"
						:phone="$footer['phone']"
					/>
				</div>
			</div>
			<div
				class="flex flex-row justify-between gap-6 sm:flex-col-reverse md:gap-8 lg:gap-10"
			>
				<x-footer.social-media
					:social-media="$footer['social_media']"
				/>
				<x-footer.language-switcher
					:page="$page"
					:session="$session"
				/>
			</div>
		</div>
		<div
			class="flex flex-col flex-wrap items-center gap-2 border-t border-slate-200 pt-4 text-slate-700 md:flex-row md:justify-between lg:gap-x-8"
		>
			<x-footer.copyright
				:copyright="$footer['copyright']"
				:organization="$footer['organization']"
			/>
			<x-footer.legal-links
				:links="$footer['links']"
			/>
		</div>
	</x-footer.root>
@endsection
