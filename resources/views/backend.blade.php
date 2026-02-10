<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8" />
	<meta
		content="width=device-width, initial-scale=1.0, maximum-scale=5.0"
		name="viewport" />
	<link
		href="/favicon.svg"
		rel="icon" />

	@routes
	@viteReactRefresh
	@vite(['resources/css/backend.css', 'resources/js/backend.tsx'])
	@inertiaHead
</head>

<body class="antialiased">
	@inertia
</body>

</html>