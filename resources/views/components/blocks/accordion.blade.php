@php
	$containerPadding = match (true) {
	    $paddingTop === 'lg' || $paddingBottom === 'lg'
	        => 'pt-16 pb-16 md:pt-24 md:pb-24 lg:pt-32 lg:pb-32 xl:pt-40 xl:pb-40',
	    $paddingTop === 'md' || $paddingBottom === 'md'
	        => 'pt-8 pb-8 md:pt-12 md:pb-12 lg:pt-16 lg:pb-16 xl:pt-20 xl:pb-20',
	    $paddingTop === 'sm' || $paddingBottom === 'sm' => 'pt-4 pb-4 md:pt-6 md:pb-6 lg:pt-8 lg:pb-8 xl:pt-10 xl:pb-10',
	    default => '',
	};
@endphp

<x-narsil::ui.container.container-root
	class="{{ $containerPadding }} flex flex-col items-center gap-4"
	data-narsil-node="{{ $nodeId }}"
>
	<x-narsil::ui.accordion.accordion-root>
		@foreach ($data['items'] ?? [] as $index => $item)
			<x-narsil::ui.accordion.accordion-item
				:data-narsil-node="$item['uuid'] ?? ''"
				:value="$index"
			>
				<x-narsil::ui.accordion.accordion-header>
					<x-narsil::ui.accordion.accordion-trigger
						:value="$index"
					>
						<span>
							{{ $item['children']['trigger'] }}
						</span>
						<x-narsil::ui.icon.icon-root
							class="pointer-events-none size-4 shrink-0 transition-transform duration-300 group-data-[state=open]/accordion-trigger:rotate-180"
							name="fa-regular-chevron-down"
						/>
					</x-narsil::ui.accordion.accordion-trigger>
				</x-narsil::ui.accordion.accordion-header>
				<x-narsil::ui.accordion.accordion-panel
					:value="$index"
				>
					<div
						class="prose [&_a]:underline-offset-3 [&_a]:hover:text-foreground [&_a]:underline [&_p:not(:last-child)]:mb-4"
					>
						{!! $item['children']['content'] !!}
					</div>
				</x-narsil::ui.accordion.accordion-panel>
			</x-narsil::ui.accordion.accordion-item>
		@endforeach
	</x-narsil::ui.accordion.accordion-root>
</x-narsil::ui.container.container-root>
