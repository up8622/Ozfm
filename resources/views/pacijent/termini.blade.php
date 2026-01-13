<x-layouts.app>
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Termini</h1>
    
    <!-- Add New Termin Form -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-8">
        <h2 class="text-xl font-semibold mb-4">Dodaj Novi Termin</h2>
        <form action="{{ route('pacijent.termini.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label for="vreme" class="block text-sm font-medium text-gray-700">Vreme</label>
                    <input type="datetime-local" id="vreme" name="vreme" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label for="terapeut_id" class="block text-sm font-medium text-gray-700">Terapeut</label>
                    <select id="terapeut_id" name="terapeut_id" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Izaberite terapeuta</option>
                        @foreach($terapeuti as $terapeut)
                        <option value="{{ $terapeut->id }}">{{ $terapeut->ime }} {{ $terapeut->prezime }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="usluga_id" class="block text-sm font-medium text-gray-700">Usluga</label>
                    <select id="usluga_id" name="usluga_id" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Izaberite uslugu</option>
                        @foreach($usluge as $usluga)
                        <option value="{{ $usluga->id }}">{{ $usluga->naziv }} - {{ $usluga->cena }} RSD</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Dodaj Termin
                    </button>
                </div>
            </div>
        </form>
    </div>
    
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vreme</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Terapeut</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Broj telefona</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usluga</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cena</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($termins as $termin)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $termin->vreme->format('d.m.Y H:i') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $termin->terapeut->ime }} {{ $termin->terapeut->prezime }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $termin->terapeut->broj_telefona }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $termin->usluga->naziv }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $termin->usluga->cena }} RSD
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</x-layouts.app>