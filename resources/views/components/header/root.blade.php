<header
	{{ $attributes->twMerge('bg-layout text-layout-foreground sticky left-0 right-0 top-0 z-10 flex w-full items-center justify-between px-4 py-2 md:px-4 md:py-4 lg:px-14 xl:px-20') }}
	x-data="{ navigationOpen: false }"
>
	{{ $slot }}
</header>
