<x-layouts.app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Moji Tretmani') }}</h2>
            <a href="{{ route('terapeut.logout') }}"
               class="inline-block px-4 py-2 bg-red-500 hover:bg-red-700 text-white font-bold rounded-md text-sm leading-normal">
                {{ __('Logout') }}
            </a>
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pacijent</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Broj telefona</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usluga</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cena</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Detalji</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($termins as $termin)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $termin->vreme->format('d.m.Y H:i') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $termin->pacijent->ime }} {{ $termin->pacijent->prezime }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $termin->pacijent->broj_telefona }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $termin->usluga->naziv }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $termin->usluga->cena }} RSD</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button type="button" class="text-blue-600 hover:text-blue-900" onclick="showPacijentDetails({{ $termin->pacijent->id }}, '{{ $termin->pacijent->ime }}', '{{ $termin->pacijent->prezime }}', {{ $termin->pacijent->godina_rodjenja }}, '{{ $termin->pacijent->broj_telefona }}', '{{ $termin->pacijent->username }}', '{{ $termin->pacijent->created_at ? $termin->pacijent->created_at->format('d.m.Y H:i') : 'N/A' }}')">
                                    {{-- <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg> --}}
                                    Detalji
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="px-6 py-4" colspan="6">Nemate zakazanih tretmana.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pacijent Details Modal -->
    <div id="pacijentModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Detalji o pacijentu</h3>
                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Ime:</label>
                        <p class="text-sm text-gray-900" id="modal-ime"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Prezime:</label>
                        <p class="text-sm text-gray-900" id="modal-prezime"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Godina rođenja:</label>
                        <p class="text-sm text-gray-900" id="modal-godina"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Broj telefona:</label>
                        <p class="text-sm text-gray-900" id="modal-telefon"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Korisničko ime:</label>
                        <p class="text-sm text-gray-900" id="modal-username"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Datum registracije:</label>
                        <p class="text-sm text-gray-900" id="modal-created"></p>
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                    <button type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded" onclick="closePacijentModal()">Zatvori</button>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>

<script>
    function showPacijentDetails(id, ime, prezime, godina, telefon, username, created) {
        document.getElementById('modal-ime').textContent = ime;
        document.getElementById('modal-prezime').textContent = prezime;
        document.getElementById('modal-godina').textContent = godina;
        document.getElementById('modal-telefon').textContent = telefon;
        document.getElementById('modal-username').textContent = username;
        document.getElementById('modal-created').textContent = created;
        document.getElementById('pacijentModal').classList.remove('hidden');
    }

    function closePacijentModal() {
        document.getElementById('pacijentModal').classList.add('hidden');
    }
</script>