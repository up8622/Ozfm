<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Terapeuti') }}</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-4">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ime</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prezime</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telefon</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($terapeuti as $terapeut)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $terapeut->ime }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $terapeut->prezime }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $terapeut->broj_telefona }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $terapeut->username }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td class="px-6 py-4" colspan="4">No terapeuti found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app>
