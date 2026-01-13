<x-layouts.app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Termini') }}</h2>
            <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="openAddModal()">
                Dodaj termin
            </button>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-4">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vreme</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Terapeut</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Broj telefona</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usluga</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cena</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($termins as $termin)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $termin->vreme->format('d.m.Y H:i') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $termin->terapeut->ime }} {{ $termin->terapeut->prezime }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $termin->terapeut->broj_telefona }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $termin->usluga->naziv }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $termin->usluga->cena }} RSD</td>
                        </tr>
                        @empty
                        <tr>
                            <td class="px-6 py-4" colspan="5">No termins found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="terminModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Dodaj Novi Termin</h3>
                <form action="{{ route('pacijent.termini.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="vreme" class="block text-sm font-medium text-gray-700">Vreme</label>
                        <input type="datetime-local" id="vreme" name="vreme" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="terapeut_id" class="block text-sm font-medium text-gray-700">Terapeut</label>
                        <select id="terapeut_id" name="terapeut_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="">Izaberite terapeuta</option>
                            @foreach($terapeuti as $terapeut)
                            <option value="{{ $terapeut->id }}">{{ $terapeut->ime }} {{ $terapeut->prezime }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="usluga_id" class="block text-sm font-medium text-gray-700">Usluga</label>
                        <select id="usluga_id" name="usluga_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="">Izaberite uslugu</option>
                            @foreach($usluge as $usluga)
                            <option value="{{ $usluga->id }}">{{ $usluga->naziv }} - {{ $usluga->cena }} RSD</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="mr-3 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded" onclick="closeModal()">Cancel</button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Dodaj Termin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openAddModal() {
            document.getElementById('terminModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('terminModal').classList.add('hidden');
        }
    </script>
</x-layouts.app>