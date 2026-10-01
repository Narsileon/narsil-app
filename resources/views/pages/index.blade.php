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
	<x-blocks.organization-schema.organization-schema-root
		:footer="$footer"
		:session="$session"
	/>
@endsection

@section('body')
	<x-layout.header.header-root>
		<x-ui.brand.brand-root />
		<button
			aria-label="Toggle navigation"
			class="md:hidden"
			data-slot="header-navigation-toggle"
			type="button"
			@click="navigationOpen = !navigationOpen"
		>
			<x-narsil::ui.icon.icon-root
				name="fa-regular-bars"
			/>
		</button>
		<x-layout.navigation.navigation-root
			:items="$navigation[0]['children'] ?? []"
		/>
	</x-layout.header.header-root>
	<main
		class="bg-background text-foreground flex h-fit min-h-svh flex-col items-center justify-center"
	>
		<div
			class="w-full"
		>
			@foreach ($page['data'] ?? [] as $element)
				@if (is_array($element) && array_is_list($element))
					@foreach ($element as $content)
						<x-contents.content-renderer
							:content="$content"
						/>
					@endforeach
				@elseif (is_array($element))
					<x-contents.content-renderer
						:content="$element"
					/>
				@endif
			@endforeach
		</div>
	</main>
	<x-layout.footer.footer-root
		:footer="$footer"
		:page="$page"
		:session="$session"
	/>
@endsection
