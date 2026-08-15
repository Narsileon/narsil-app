<section
	class="{{ $paddingTop }} {{ $paddingBottom }} mx-auto flex w-full max-w-7xl flex-col items-center gap-4 px-4"
	data-narsil-node="{{ $nodeId }}"
	x-data="{ active: null }"
>
	@foreach ($data['items'] ?? [] as $index => $item)
		<div
			class="not-last:border-b w-full"
			data-narsil-node="{{ $item['uuid'] ?? '' }}"
		>
			<button
				:aria-expanded="active === {{ $index }}"
				@click="active = active === {{ $index }} ? null : {{ $index }}"
				class="group/accordion-trigger relative flex w-full flex-1 cursor-pointer items-start justify-between rounded-lg border border-transparent py-2.5 text-left text-sm font-medium outline-none transition-all hover:underline focus-visible:underline"
				type="button"
			>
				<span>{{ $item['children']['trigger'] }}</span>
				<svg
					:class="active === {{ $index }} ? 'rotate-180' : ''"
					aria-hidden="true"
					class="pointer-events-none size-4 shrink-0 transition-transform duration-300"
					fill="none"
					stroke-width="2"
					stroke="currentColor"
					viewBox="0 0 24 24"
				>
					<path
						d="m6 9 6 6 6-6"
						stroke-linecap="round"
						stroke-linejoin="round"
					/>
				</svg>
			</button>
			<div
				class="overflow-hidden text-sm"
				x-cloak
				x-show="active === {{ $index }}"
				x-transition
			>
				<div
					class="prose [&_a]:underline-offset-3 [&_a]:hover:text-foreground pb-2.5 pt-0 [&_a]:underline [&_p:not(:last-child)]:mb-4"
				>{!! $item['children']['content'] !!}</div>
			</div>
		</div>
	@endforeach
</section>
