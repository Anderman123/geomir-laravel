<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        {{-- <x-language-switcher /> --}}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                    <!-- HECHO POR MI -->
                    <h2>{{ __('Recursos mios') }}</h2>
                    </br>
                    @can('viewAny',App\Models\File::class)
                        <a href="{{ url('/files') }}">{{ __('Files') }}</a>
                        </br>
                    @endcan 

                    <a href="{{ url('/files/create') }}">{{ __('Create') }}</a>

                    @can('viewAny',App\Models\Place::class)
                        </br>
                        <a href="{{ url('/places') }}">{{ __('Places') }}</a>
                    @endcan 
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
