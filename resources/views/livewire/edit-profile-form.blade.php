<div class="w-full md:w-1/2 space-y-4">
    <div class="filament-card p-6 bg-white dark:bg-gray-800 rounded-xl shadow">
        <form wire:submit.prevent="update" class="space-y-4 flex flex-col">
            {{ $this->form }}

            <x-filament::button type="submit" color="primary" class="ml-auto">
                Update Profile
            </x-filament::button>
        </form>
    </div>
</div>
