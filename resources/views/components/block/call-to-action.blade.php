<x-ui.container
	:padding-bottom="$paddingBottom"
	:padding-top="$paddingTop"
	class="flex justify-center"
	data-narsil-node="{{ $nodeId }}"
>
	<x-block.button
		:data="$data"
		:node-id="$nodeId"
	/>
</x-ui.container>
