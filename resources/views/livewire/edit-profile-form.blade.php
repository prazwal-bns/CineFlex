<div class="w-full md:w-1/2 space-y-4">
    <div class="filament-card p-6 bg-white dark:bg-gray-800 rounded-xl shadow">
        <form wire:submit.prevent="update" class="space-y-4 flex flex-col">
            {{ $this->form }}

            <div>
                {{ $this->getSaveAction() }}
            </div>
        </form>
    </div>
</div>
