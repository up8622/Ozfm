<x-layouts.app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-900">{{ __('Termini') }}</h2>
            <div class="flex items-center space-x-4">
                <button type="button" class="rounded-md bg-sky-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-sky-700" onclick="openAddModal()">
                    Dodaj termin
                </button>
                <a href="{{ route('pacijent.logout') }}"
                   class="inline-block rounded-md bg-red-500 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-red-600">
                    {{ __('Logout') }}
                </a>
            </div>
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
                            <th class="px-6 py-3 text-left text-[11px] font-medium uppercase tracking-wider text-gray-900">Terapeut</th>
                            <th class="px-6 py-3 text-left text-[11px] font-medium uppercase tracking-wider text-gray-900">Broj telefona</th>
                            <th class="px-6 py-3 text-left text-[11px] font-medium uppercase tracking-wider text-gray-900">Usluga</th>
                            <th class="px-6 py-3 text-left text-[11px] font-medium uppercase tracking-wider text-gray-900">Cena</th>
                            <th class="px-6 py-3 text-left text-[11px] font-medium uppercase tracking-wider text-gray-900">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse($termins as $termin)
                        <tr>
                            <td class="whitespace-nowrap px-6 py-4 text-gray-900">{{ $termin->vreme->format('d.m.Y H:i') }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-gray-900">{{ $termin->terapeut->ime }} {{ $termin->terapeut->prezime }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-gray-900">{{ $termin->terapeut->broj_telefona }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-gray-900">{{ $termin->usluga->naziv }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-gray-900">{{ $termin->usluga->cena }} RSD</td>
                            <td class="whitespace-nowrap px-6 py-4 text-gray-900">
                                <button type="button" class="font-medium text-red-500 hover:text-red-700" onclick="confirmDelete({{ $termin->id }}, '{{ $termin->vreme->format('d.m.Y H:i') }} - {{ $termin->terapeut->ime }} {{ $termin->terapeut->prezime }}')">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="px-6 py-6 text-center text-gray-500" colspan="6">No termins found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="terminModal" class="fixed inset-0 z-50 flex overflow-y-auto bg-gray-900/40 p-4 hidden">
        <div class="m-auto w-full max-w-sm rounded-lg border border-gray-200 bg-white p-5 shadow-xl">
            <div>
                <h3 class="mb-4 text-base font-semibold text-gray-900">Dodaj Novi Termin</h3>
                <form action="{{ route('pacijent.termini.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="vreme" class="mb-1.5 block text-[11px] font-semibold uppercase tracking-wide text-gray-600">Vreme</label>
                        <input type="datetime-local" id="vreme" name="vreme" class="block w-full rounded-md border-gray-200 px-3 py-2 text-sm shadow-none focus:border-sky-500 focus:ring-sky-500" required>
                    </div>
                    <div class="mb-4">
                        <label for="terapeut_id" class="mb-1.5 block text-[11px] font-semibold uppercase tracking-wide text-gray-600">Terapeut</label>
                        <select id="terapeut_id" name="terapeut_id" class="block w-full rounded-md border-gray-200 py-2 pl-3 pr-10 text-sm text-gray-700 shadow-none focus:border-sky-500 focus:ring-sky-500" required>
                            <option value="">Izaberite terapeuta</option>
                            @foreach($terapeuti as $terapeut)
                            <option value="{{ $terapeut->id }}">{{ $terapeut->ime }} {{ $terapeut->prezime }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="usluga_id" class="mb-1.5 block text-[11px] font-semibold uppercase tracking-wide text-gray-600">Usluga</label>
                        <select id="usluga_id" name="usluga_id" class="block w-full rounded-md border-gray-200 py-2 pl-3 pr-10 text-sm text-gray-700 shadow-none focus:border-sky-500 focus:ring-sky-500" required>
                            <option value="">Izaberite uslugu</option>
                            @foreach($usluge as $usluga)
                            <option value="{{ $usluga->id }}">{{ $usluga->naziv }} - {{ $usluga->cena }} RSD</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-end pt-2">
                        <button type="button" class="mr-3 min-w-[7rem] rounded-md border border-sky-600 bg-white px-4 py-2 text-sm font-semibold text-sky-600 shadow-sm transition hover:bg-sky-50" onclick="closeModal()">Cancel</button>
                        <button type="submit" class="min-w-[7rem] rounded-md bg-sky-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-sky-700">Dodaj Termin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 z-50 flex overflow-y-auto bg-gray-900/40 p-4 hidden">
        <div class="m-auto w-full max-w-sm rounded-lg border border-gray-200 bg-white p-5 shadow-xl">
            <div>
                <h3 class="mb-4 text-base font-semibold text-gray-900">Delete Termin</h3>
                <p class="mb-5 text-sm text-gray-600">Are you sure you want to delete <span id="deleteName"></span>? This action cannot be undone.</p>
                <form id="deleteForm" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="flex justify-end pt-2">
                        <button type="button" class="mr-3 min-w-[7rem] rounded-md border border-sky-600 bg-white px-4 py-2 text-sm font-semibold text-sky-600 shadow-sm transition hover:bg-sky-50" onclick="closeDeleteModal()">Cancel</button>
                        <button type="submit" class="min-w-[7rem] rounded-md bg-red-500 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-red-600">Delete</button>
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

        function confirmDelete(id, name) {
            document.getElementById('deleteName').textContent = name;
            document.getElementById('deleteForm').action = '{{ route("pacijent.termini") }}/' + id;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>
</x-layouts.app>