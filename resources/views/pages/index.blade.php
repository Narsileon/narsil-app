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
	<x-header
		:navigation="$navigation"
		:session="$session"
	/>
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
	<x-footer
		:footer="$footer"
		:page="$page"
		:session="$session"
	/>
@endsection
