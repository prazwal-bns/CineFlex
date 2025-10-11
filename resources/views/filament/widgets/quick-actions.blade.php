<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex flex-col gap-4">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Quick Actions</h2>
            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($this->getActions() as $action)
                    @if ($action->isVisible())
                        {{ $action }}
                    @endif
                @endforeach
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
