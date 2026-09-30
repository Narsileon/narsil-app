<div {{ $attributes->twMerge('flex justify-end gap-6') }}>
	@foreach ($socialMedia as $social)
		<a
			aria-label="{{ $social['label'] }}"
			href="{{ $social['url'] }}"
			target="_blank"
		>
			<x-narsil::ui.icon.icon-root
				class="text-primary hover:text-primary/80 transition-colors"
				:name="$social['icon']"
			/>
		</a>
	@endforeach
</div>
