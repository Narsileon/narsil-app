<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

	<head>
		<meta charset="utf-8">
		<meta
			content="width=device-width, initial-scale=1.0, maximum-scale=5.0"
			name="viewport"
		>
		<link
			href="/favicon.svg"
			rel="icon"
		>
		@vite(['resources/css/frontend.css', 'resources/js/frontend.ts'])
		@yield('head')
	</head>

	<body
		class="text-sm antialiased"
		data-editor-mode="{{ $editorMode ?? false ? 'true' : 'false' }}"
	>
		@yield('body')
		<script
			defer
			src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"
		></script>
	</body>

</html>
