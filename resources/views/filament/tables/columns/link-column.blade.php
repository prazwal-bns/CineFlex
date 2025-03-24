<span class="inline-flex items-center w-full">
    <!-- Text link -->
        <x-filament::link
            class="relative px-3"
            size="{{$getSize('xs')}}"
            :color="$getColor('primary')"
            :target="$getTarget()"
            :href="$getClonedUrl()">
            {!! $getPrefix() !!}
            {{ $getState() }}
        </x-filament::link>
</span>

