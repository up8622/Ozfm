<x-layouts.app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-900">{{ __('Admin View') }}</h2>
            <a href="{{ route('admin.logout') }}"
               class="inline-block rounded-md bg-red-500 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-red-600">
                {{ __('Logout') }}
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
            <div class="px-4 py-4">
                <div class="flex justify-center space-x-8">
                    <a href="{{ route('terapeuti.index') }}"
                       class="inline-block rounded-md bg-sky-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-sky-700">
                        {{ __('Terapeuti') }}
                    </a>
                    <a href="{{ route('usluga.index') }}"
                       class="inline-block rounded-md bg-sky-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-sky-700">
                        {{ __('Usluge') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
