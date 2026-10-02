<footer
	{{ $attributes->twMerge('bg-layout text-layout-foreground mx-auto flex w-full flex-col gap-6 p-4 md:gap-8 md:px-4 md:pt-6 lg:gap-10 lg:px-14 lg:pt-6 xl:px-20 xl:pt-8')->merge([
	    'data-slot' => 'footer-root',
	]) }}
>
	<div
		class="flex flex-col justify-between gap-6 sm:flex-row"
	>
		<div
			class="flex flex-col gap-6 md:gap-8 lg:gap-10"
		>
			<x-ui.brand.brand-root />
			<div
				class="flex flex-row gap-10"
			>
				<div
					class="flex flex-col gap-0.5 lg:gap-2"
				>
					<p
						class="font-bold"
						data-slot="footer-organization"
					>
						{{ $footer['organization'] }}
					</p>
					<x-narsil::blocks.address.address-root
						:city="$footer['city']"
						:country="$footer['country']"
						:postal-code="$footer['postal_code']"
						:street="$footer['street']"
					/>
				</div>
				<div
					class="flex flex-col justify-end"
				>
					<x-narsil::ui.link.link-root
						:href="'mailto:' . ($footer['email'] ?? '')"
					>
						{{ $footer['email'] }}
					</x-narsil::ui.link.link-root>
					<x-narsil::ui.link.link-root
						:href="'tel:' . \Illuminate\Support\Str::replaceMatches('/\s+/', '', $footer['phone'] ?? '')"
					>
						{{ $footer['phone'] }}
					</x-narsil::ui.link.link-root>
				</div>
			</div>
		</div>
		<div
			class="flex flex-row justify-between gap-6 sm:flex-col-reverse md:gap-8 lg:gap-10"
		>
			<div
				class="flex justify-end gap-6"
			>
				@foreach ($footer['social_media'] as $social)
					<x-ui.social-media.social-media-root
						:label="$social['label']"
						:url="$social['url']"
					>
						<x-narsil::ui.icon.icon-root
							:name="$social['icon']"
						/>
					</x-ui.social-media.social-media-root>
				@endforeach
			</div>
			<x-blocks.language-switcher.language-switcher-root
				:page="$page"
				:session="$session"
			/>
		</div>
	</div>
	<div
		class="flex flex-col flex-wrap items-center gap-2 border-t border-slate-200 pt-4 text-slate-700 md:flex-row md:justify-between lg:gap-x-8"
	>
		<x-narsil::ui.copyright.copyright-root
			:copyright="$footer['copyright']"
			:organization="$footer['organization']"
		/>
		<nav
			class="flex gap-4 text-sm"
			data-slot="footer-legal-nav"
		>
			@foreach ($footer['links'] as $link)
				<x-narsil::ui.link.link-root
					:href="$link['url']"
				>
					{{ $link['label'] }}
				</x-narsil::ui.link.link-root>
			@endforeach
		</nav>
	</div>
</footer>
