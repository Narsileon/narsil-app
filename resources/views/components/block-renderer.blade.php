@if ($blockView)
	@if ($blockView === 'components.form')
		<x-form
			:data="$blockData"
			:node-id="$nodeId"
			:padding-bottom="$paddingBottom"
			:padding-top="$paddingTop"
		/>
	@elseif ($blockView === 'components.button')
		<x-button
			:data="$blockData"
			:node-id="$nodeId"
		/>
	@elseif ($blockView === 'components.hero-header')
		<x-hero-header
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
