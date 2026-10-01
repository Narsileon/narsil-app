@if ($contentView)
	@if ($contentView === 'components.contents.accordion.accordion-root')
		<x-contents.accordion.accordion-root
			:content-data="$contentData"
			:node-id="$nodeId"
			:padding-bottom="$paddingBottom"
			:padding-top="$paddingTop"
			{{ $attributes->twMerge() }}
		/>
	@elseif ($contentView === 'components.contents.button.button-root')
		<x-contents.button.button-root
			:content-data="$contentData"
			:node-id="$nodeId"
			{{ $attributes->twMerge() }}
		/>
	@elseif ($contentView === 'components.contents.call-to-action.call-to-action-root')
		<x-contents.call-to-action.call-to-action-root
			:content-data="$contentData"
			:node-id="$nodeId"
			:padding-bottom="$paddingBottom"
			:padding-top="$paddingTop"
			{{ $attributes->twMerge() }}
		/>
	@elseif ($contentView === 'components.contents.form.form-root')
		<x-contents.form.form-root
			:content-data="$contentData"
			:node-id="$nodeId"
			:padding-bottom="$paddingBottom"
			:padding-top="$paddingTop"
			{{ $attributes->twMerge() }}
		/>
	@elseif ($contentView === 'components.contents.hero-header.hero-header-root')
		<x-contents.hero-header.hero-header-root
			:content-data="$contentData"
			:node-id="$nodeId"
			:padding-bottom="$paddingBottom"
			:padding-top="$paddingTop"
			{{ $attributes->twMerge() }}
		/>
	@endif
@endif
