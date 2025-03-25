@php
    $user = filament()->auth()->user();
@endphp

<x-filament-widgets::widget class="fi-account-widget">
    <x-filament::section>
        <div class="flex items-center gap-x-3">
            <div class="flex items-center gap-x-3 flex-1">
                <a href="{{ route('filament.admin.pages.profile') }}">
                    <x-filament-panels::avatar.user size="lg" :user="$user" />
                </a>

                <div class="flex-1">
                    <h2 class="grid flex-1 text-base font-semibold leading-6 text-gray-950 dark:text-white">
                        {{ __('filament-panels::widgets/account-widget.welcome', ['app' => config('app.name')]) }}
                    </h2>

                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        <a href="{{ route('filament.admin.pages.profile') }}" class="hover:text-primary-600">
                            {{ filament()->getUserName($user) }}
                        </a>
                    </p>
                </div>
            </div>

            <form
                action="{{ filament()->getLogoutUrl() }}"
                method="post"
                class="my-auto"
            >
                @csrf

                <x-filament::button
                    color="gray"
                    icon="heroicon-m-arrow-left-on-rectangle"
                    icon-alias="panels::widgets.account.logout-button"
                    labeled-from="sm"
                    tag="button"
                    type="submit"
                >
                    {{ __('filament-panels::widgets/account-widget.actions.logout.label') }}
                </x-filament::button>
            </form>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
