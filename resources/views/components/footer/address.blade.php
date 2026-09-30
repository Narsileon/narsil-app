<address {{ $attributes->twMerge('flex flex-col gap-0.5 not-italic') }}>
	<span class="min-h-6">
		{{ $street }}
	</span>
	<span class="min-h-6">
		{{ $postalCode }} {{ $city }} - {{ $country }}
	</span>
</address>
