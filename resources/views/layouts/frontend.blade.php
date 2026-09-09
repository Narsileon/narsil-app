<!DOCTYPE
	html
>
<html
	lang="{{ str_replace('_', '-', app()->getLocale()) }}"
>

<head>
	<meta
		charset="utf-8"
	>
	<meta
		content="width=device-width, initial-scale=1.0, maximum-scale=5.0"
		name="viewport"
	>
	<link
		href="/favicon.svg"
		rel="icon"
	>
	@vite(['resources/css/frontend.css', 'resources/js/frontend-livewire.ts'])
	@livewireStyles
	@yield('head')
</head>

<body
	class="text-base antialiased"
	data-editor-mode="{{ $editorMode ?? false ? 'true' : 'false' }}"
>
	@yield('body')
	@livewireScriptConfig
</body>

</html>
