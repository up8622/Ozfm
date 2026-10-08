<x-layouts.app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-900">{{ __('Usluge') }}</h2>
            <button type="button" class="rounded-md bg-sky-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-sky-700" onclick="openAddModal()">
                Dodaj uslugu
            </button>
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
                            <th class="px-6 py-3 text-left text-[11px] font-medium uppercase tracking-wider text-gray-900">Naziv</th>
                            <th class="px-6 py-3 text-left text-[11px] font-medium uppercase tracking-wider text-gray-900">Cena</th>
                            <th class="px-6 py-3 text-left text-[11px] font-medium uppercase tracking-wider text-gray-900">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse($usluge as $usluga)
                        <tr>
                            <td class="whitespace-nowrap px-6 py-4 text-gray-900">{{ $usluga->naziv }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-gray-900">{{ $usluga->cena }} RSD</td>
                            <td class="whitespace-nowrap px-6 py-4 text-gray-900">
                                <button type="button" class="mr-2 font-medium text-sky-600 hover:text-sky-800" onclick="editUsluga({{ $usluga->id }}, '{{ $usluga->naziv }}', {{ $usluga->cena }})">
                                    Edit
                                </button>
                                <button type="button" class="font-medium text-red-500 hover:text-red-700" onclick="confirmDelete({{ $usluga->id }}, '{{ $usluga->naziv }}')">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="px-6 py-6 text-center text-gray-500" colspan="3">No usluge found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="uslugaModal" class="fixed inset-0 z-50 flex overflow-y-auto bg-gray-900/40 p-4 hidden">
        <div class="m-auto w-full max-w-sm rounded-lg border border-gray-200 bg-white p-5 shadow-xl">
            <div>
                <h3 id="modalTitle" class="mb-4 text-base font-semibold text-gray-900">Add New Usluga</h3>
                <form id="uslugaForm" action="{{ route('usluga.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" id="methodField" value="POST">
                    <input type="hidden" name="usluga_id" id="uslugaId">
                    <div class="mb-4">
                        <label for="naziv" class="mb-1.5 block text-[11px] font-semibold uppercase tracking-wide text-gray-600">Naziv</label>
                        <input type="text" name="naziv" id="naziv" class="block w-full rounded-md border-gray-200 px-3 py-2 text-sm shadow-none focus:border-sky-500 focus:ring-sky-500" required>
                    </div>
                    <div class="mb-4">
                        <label for="cena" class="mb-1.5 block text-[11px] font-semibold uppercase tracking-wide text-gray-600">Cena (RSD)</label>
                        <input type="number" step="0.01" name="cena" id="cena" class="block w-full rounded-md border-gray-200 px-3 py-2 text-sm shadow-none focus:border-sky-500 focus:ring-sky-500" required>
                    </div>
                    <div class="flex justify-end pt-2">
                        <button type="button" class="mr-3 min-w-[7rem] rounded-md border border-sky-600 bg-white px-4 py-2 text-sm font-semibold text-sky-600 shadow-sm transition hover:bg-sky-50" onclick="closeModal()">Cancel</button>
                        <button type="submit" id="submitButton" class="min-w-[7rem] rounded-md bg-sky-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-sky-700">Add Usluga</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 z-50 flex overflow-y-auto bg-gray-900/40 p-4 hidden">
        <div class="m-auto w-full max-w-sm rounded-lg border border-gray-200 bg-white p-5 shadow-xl">
            <div>
                <h3 class="mb-4 text-base font-semibold text-gray-900">Delete Usluga</h3>
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
            document.getElementById('modalTitle').textContent = 'Add New Usluga';
            document.getElementById('uslugaForm').action = '{{ route("usluga.store") }}';
            document.getElementById('methodField').value = 'POST';
            document.getElementById('uslugaId').value = '';
            document.getElementById('submitButton').textContent = 'Add Usluga';
            document.getElementById('naziv').value = '';
            document.getElementById('cena').value = '';
            document.getElementById('uslugaModal').classList.remove('hidden');
        }

        function editUsluga(id, naziv, cena) {
            document.getElementById('modalTitle').textContent = 'Edit Usluga';
            document.getElementById('uslugaForm').action = '/admin/usluga/' + id;
            document.getElementById('methodField').value = 'PUT';
            document.getElementById('uslugaId').value = id;
            document.getElementById('submitButton').textContent = 'Update Usluga';
            document.getElementById('naziv').value = naziv;
            document.getElementById('cena').value = cena;
            document.getElementById('uslugaModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('uslugaModal').classList.add('hidden');
        }

        function confirmDelete(id, name) {
            document.getElementById('deleteName').textContent = name;
            document.getElementById('deleteForm').action = '/admin/usluga/' + id;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>
</x-layouts.app>