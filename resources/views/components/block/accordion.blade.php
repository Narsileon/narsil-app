<x-ui.container
	:padding-bottom="$paddingBottom"
	:padding-top="$paddingTop"
	class="flex flex-col items-center gap-4"
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
				<span>
					{{ $item['children']['trigger'] }}
				</span>
				<x-icon.chevron-down
					:class="active === {{ $index }} ? 'rotate-180' : ''"
					class="pointer-events-none size-5 shrink-0 transition-transform duration-300"
				/>
			</button>
			<div
				:aria-hidden="active !== {{ $index }}"
				:class="active === {{ $index }} ? 'grid-rows-[1fr] opacity-100' : 'grid-rows-[0fr] opacity-0'"
				:inert="active !== {{ $index }}"
				class="grid overflow-hidden text-sm transition-[grid-template-rows,opacity] duration-300 ease-out"
			>
				<div
					class="min-h-0"
				>
					<div
						class="prose [&_a]:underline-offset-3 [&_a]:hover:text-foreground pb-2.5 pt-0 [&_a]:underline [&_p:not(:last-child)]:mb-4"
					>
						{!! $item['children']['content'] !!}
					</div>
				</div>
			</div>
		</div>
	@endforeach
</x-ui.container>
