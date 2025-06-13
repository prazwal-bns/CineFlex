<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex flex-col gap-4">
            <h2 class="text-lg font-bold">Quick Actions</h2>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                @foreach ($this->getActions() as $action)
                    {{ $action }}
                @endforeach
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
