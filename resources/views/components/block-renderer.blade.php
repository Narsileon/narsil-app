@if ($blockView)
	@if ($blockView === 'components.blocks.form')
		<x-blocks.form
			:data="$blockData"
			:node-id="$nodeId"
			:padding-bottom="$paddingBottom"
			:padding-top="$paddingTop"
		/>
	@elseif ($blockView === 'components.blocks.button')
		<x-blocks.button
			:data="$blockData"
			:node-id="$nodeId"
		/>
	@elseif ($blockView === 'components.blocks.hero-header')
		<x-blocks.hero-header
			:data="$blockData"
			:node-id="$nodeId"
			:padding-bottom="$paddingBottom"
			:padding-top="$paddingTop"
		/>
	@else
		@include($blockView, [
			'data' => $blockData,
			'nodeId' => $nodeId,
			'paddingTop' => $paddingTop,
			'paddingBottom' => $paddingBottom,
		])
	@endif
@endif
