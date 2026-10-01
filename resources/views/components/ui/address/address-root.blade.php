<address
	{{ $attributes->twMerge('flex flex-col gap-0.5 not-italic')->merge([
	    'data-slot' => 'address-root',
	]) }}
>
	<span>
		{{ $street }}
	</span>
	<span>
		{{ $postalCode }} {{ $city }} - {{ $country }}
	</span>
</address>
