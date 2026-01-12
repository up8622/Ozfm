<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Admin View') }}</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-4">
                <div class="flex justify-center space-x-8">
                    <a href="{{ route('terapeuti.index') }}"
                       class="inline-block px-6 py-3 bg-blue-500 hover:bg-blue-700 text-white font-bold rounded-md text-sm leading-normal">
                        {{ __('Terapeuti') }}
                    </a>
                    <a href="{{ route('usluga.index') }}"
                       class="inline-block px-6 py-3 bg-blue-500 hover:bg-blue-700 text-white font-bold rounded-md text-sm leading-normal">
                        {{ __('Usluge') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
