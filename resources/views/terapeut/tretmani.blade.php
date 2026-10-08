<x-layouts.app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-900">{{ __('Moji Tretmani') }}</h2>
            <a href="{{ route('terapeut.logout') }}"
               class="inline-block rounded-md bg-red-500 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-red-600">
                {{ __('Logout') }}
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-4 rounded-md border border-emerald-300 bg-emerald-100 px-4 py-3 text-sm font-semibold text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100 text-sm">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-[11px] font-medium uppercase tracking-wider text-gray-900">Vreme</th>
                            <th class="px-6 py-3 text-left text-[11px] font-medium uppercase tracking-wider text-gray-900">Pacijent</th>
                            <th class="px-6 py-3 text-left text-[11px] font-medium uppercase tracking-wider text-gray-900">Broj telefona</th>
                            <th class="px-6 py-3 text-left text-[11px] font-medium uppercase tracking-wider text-gray-900">Usluga</th>
                            <th class="px-6 py-3 text-left text-[11px] font-medium uppercase tracking-wider text-gray-900">Cena</th>
                            <th class="px-6 py-3 text-left text-[11px] font-medium uppercase tracking-wider text-gray-900">Detalji</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse($termins as $termin)
                        <tr>
                            <td class="whitespace-nowrap px-6 py-4 text-gray-900">{{ $termin->vreme->format('d.m.Y H:i') }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-gray-900">{{ $termin->pacijent->ime }} {{ $termin->pacijent->prezime }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-gray-900">{{ $termin->pacijent->broj_telefona }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-gray-900">{{ $termin->usluga->naziv }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-gray-900">{{ $termin->usluga->cena }} RSD</td>
                            <td class="whitespace-nowrap px-6 py-4 text-gray-900">
                                <button type="button" class="font-medium text-sky-600 hover:text-sky-800" onclick="showPacijentDetails({{ $termin->pacijent->id }}, '{{ $termin->pacijent->ime }}', '{{ $termin->pacijent->prezime }}', {{ $termin->pacijent->godina_rodjenja }}, '{{ $termin->pacijent->broj_telefona }}', '{{ $termin->pacijent->username }}', '{{ $termin->pacijent->created_at ? $termin->pacijent->created_at->format('d.m.Y H:i') : 'N/A' }}')">
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
                            <td class="px-6 py-6 text-center text-gray-500" colspan="6">Nemate zakazanih tretmana.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pacijent Details Modal -->
    <div id="pacijentModal" class="fixed inset-0 z-50 flex overflow-y-auto bg-gray-900/40 p-4 hidden">
        <div class="m-auto w-full max-w-sm rounded-lg border border-gray-200 bg-white p-5 shadow-xl">
            <div>
                <h3 class="mb-4 text-base font-semibold text-gray-900">Detalji o pacijentu</h3>
                <div class="space-y-3">
                    <div>
                        <label class="mb-1.5 block text-[11px] font-semibold uppercase tracking-wide text-gray-600">Ime:</label>
                        <p class="text-sm text-gray-900" id="modal-ime"></p>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-[11px] font-semibold uppercase tracking-wide text-gray-600">Prezime:</label>
                        <p class="text-sm text-gray-900" id="modal-prezime"></p>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-[11px] font-semibold uppercase tracking-wide text-gray-600">Godina rođenja:</label>
                        <p class="text-sm text-gray-900" id="modal-godina"></p>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-[11px] font-semibold uppercase tracking-wide text-gray-600">Broj telefona:</label>
                        <p class="text-sm text-gray-900" id="modal-telefon"></p>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-[11px] font-semibold uppercase tracking-wide text-gray-600">Korisničko ime:</label>
                        <p class="text-sm text-gray-900" id="modal-username"></p>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-[11px] font-semibold uppercase tracking-wide text-gray-600">Datum registracije:</label>
                        <p class="text-sm text-gray-900" id="modal-created"></p>
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                    <button type="button" class="min-w-[7rem] rounded-md border border-sky-600 bg-white px-4 py-2 text-sm font-semibold text-sky-600 shadow-sm transition hover:bg-sky-50" onclick="closePacijentModal()">Zatvori</button>
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