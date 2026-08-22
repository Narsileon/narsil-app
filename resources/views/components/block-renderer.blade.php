@if ($blockView)
	@if ($blockView === 'components.block.form')
		<x-block.form
			:data="$blockData"
			:node-id="$nodeId"
			:padding-bottom="$paddingBottom"
			:padding-top="$paddingTop"
		/>
	@elseif ($blockView === 'components.block.button')
		<x-block.button
			:data="$blockData"
			:node-id="$nodeId"
		/>
	@elseif ($blockView === 'components.block.hero-header')
		<x-block.hero-header
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
