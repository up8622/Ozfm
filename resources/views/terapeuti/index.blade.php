<x-layouts.app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-900">{{ __('Terapeuti') }}</h2>
            <button type="button" class="rounded-md bg-sky-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-sky-700" onclick="openAddModal()">
                Dodaj terapeuta
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
                            <th class="px-6 py-3 text-left text-[11px] font-medium uppercase tracking-wider text-gray-900">Ime</th>
                            <th class="px-6 py-3 text-left text-[11px] font-medium uppercase tracking-wider text-gray-900">Prezime</th>
                            <th class="px-6 py-3 text-left text-[11px] font-medium uppercase tracking-wider text-gray-900">Telefon</th>
                            <th class="px-6 py-3 text-left text-[11px] font-medium uppercase tracking-wider text-gray-900">Username</th>
                            <th class="px-6 py-3 text-left text-[11px] font-medium uppercase tracking-wider text-gray-900">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse($terapeuti as $terapeut)
                        <tr>
                            <td class="whitespace-nowrap px-6 py-4 text-gray-900">{{ $terapeut->ime }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-gray-900">{{ $terapeut->prezime }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-gray-900">{{ $terapeut->broj_telefona }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-gray-900">{{ $terapeut->username }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-gray-900">
                                <button type="button" class="mr-2 font-medium text-sky-600 hover:text-sky-800" onclick="editTerapeut({{ $terapeut->id }}, '{{ $terapeut->ime }}', '{{ $terapeut->prezime }}', '{{ $terapeut->jmbg }}', '{{ $terapeut->broj_telefona }}', '{{ $terapeut->username }}')">
                                    Edit
                                </button>
                                <button type="button" class="font-medium text-red-500 hover:text-red-700" onclick="confirmDelete({{ $terapeut->id }}, '{{ $terapeut->ime }} {{ $terapeut->prezime }}')">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="px-6 py-6 text-center text-gray-500" colspan="5">No terapeuti found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="terapeutModal" class="fixed inset-0 z-50 flex overflow-y-auto bg-gray-900/40 p-4 hidden">
        <div class="m-auto w-full max-w-sm rounded-lg border border-gray-200 bg-white p-5 shadow-xl">
            <div>
                <h3 id="modalTitle" class="mb-4 text-base font-semibold text-gray-900">Add New Terapeut</h3>
                <form id="terapeutForm" action="{{ route('terapeuti.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" id="methodField" value="POST">
                    <input type="hidden" name="terapeut_id" id="terapeutId">
                    <div class="mb-4">
                        <label for="ime" class="mb-1.5 block text-[11px] font-semibold uppercase tracking-wide text-gray-600">Ime</label>
                        <input type="text" name="ime" id="ime" class="block w-full rounded-md border-gray-200 px-3 py-2 text-sm shadow-none focus:border-sky-500 focus:ring-sky-500" required>
                    </div>
                    <div class="mb-4">
                        <label for="prezime" class="mb-1.5 block text-[11px] font-semibold uppercase tracking-wide text-gray-600">Prezime</label>
                        <input type="text" name="prezime" id="prezime" class="block w-full rounded-md border-gray-200 px-3 py-2 text-sm shadow-none focus:border-sky-500 focus:ring-sky-500" required>
                    </div>
                    <div class="mb-4">
                        <label for="jmbg" class="mb-1.5 block text-[11px] font-semibold uppercase tracking-wide text-gray-600">JMBG</label>
                        <input type="text" name="jmbg" id="jmbg" class="block w-full rounded-md border-gray-200 px-3 py-2 text-sm shadow-none focus:border-sky-500 focus:ring-sky-500" required>
                    </div>
                    <div class="mb-4">
                        <label for="broj_telefona" class="mb-1.5 block text-[11px] font-semibold uppercase tracking-wide text-gray-600">Broj Telefona</label>
                        <input type="text" name="broj_telefona" id="broj_telefona" class="block w-full rounded-md border-gray-200 px-3 py-2 text-sm shadow-none focus:border-sky-500 focus:ring-sky-500" required>
                    </div>
                    <div class="mb-4">
                        <label for="username" class="mb-1.5 block text-[11px] font-semibold uppercase tracking-wide text-gray-600">Username</label>
                        <input type="text" name="username" id="username" class="block w-full rounded-md border-gray-200 px-3 py-2 text-sm shadow-none focus:border-sky-500 focus:ring-sky-500" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="mb-1.5 block text-[11px] font-semibold uppercase tracking-wide text-gray-600">Password</label>
                        <input type="password" name="password" id="password" class="block w-full rounded-md border-gray-200 px-3 py-2 text-sm shadow-none focus:border-sky-500 focus:ring-sky-500">
                        <small id="passwordHint" class="mt-1 block text-xs text-gray-500">Leave blank to keep current password</small>
                    </div>
                    <div class="flex justify-end pt-2">
                        <button type="button" class="mr-3 min-w-[7rem] rounded-md border border-sky-600 bg-white px-4 py-2 text-sm font-semibold text-sky-600 shadow-sm transition hover:bg-sky-50" onclick="closeModal()">Cancel</button>
                        <button type="submit" id="submitButton" class="min-w-[7rem] rounded-md bg-sky-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-sky-700">Add Terapeut</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openAddModal() {
            document.getElementById('modalTitle').textContent = 'Add New Terapeut';
            document.getElementById('terapeutForm').action = '{{ route("terapeuti.store") }}';
            document.getElementById('methodField').value = 'POST';
            document.getElementById('terapeutId').value = '';
            document.getElementById('submitButton').textContent = 'Add Terapeut';
            document.getElementById('ime').value = '';
            document.getElementById('prezime').value = '';
            document.getElementById('jmbg').value = '';
            document.getElementById('broj_telefona').value = '';
            document.getElementById('username').value = '';
            document.getElementById('password').value = '';
            document.getElementById('password').required = true;
            document.getElementById('passwordHint').classList.toggle('hidden', true);
            document.getElementById('terapeutModal').classList.remove('hidden');
        }

        function editTerapeut(id, ime, prezime, jmbg, broj_telefona, username) {
            document.getElementById('modalTitle').textContent = 'Edit Terapeut';
            document.getElementById('terapeutForm').action = '/admin/terapeuti/' + id;
            document.getElementById('methodField').value = 'PUT';
            document.getElementById('terapeutId').value = id;
            document.getElementById('submitButton').textContent = 'Update Terapeut';
            document.getElementById('ime').value = ime;
            document.getElementById('prezime').value = prezime;
            document.getElementById('jmbg').value = jmbg;
            document.getElementById('broj_telefona').value = broj_telefona;
            document.getElementById('username').value = username;
            document.getElementById('password').value = '';
            document.getElementById('password').required = false;
            document.getElementById('passwordHint').classList.toggle('hidden', false);
            document.getElementById('terapeutModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('terapeutModal').classList.add('hidden');
        }

        function confirmDelete(id, name) {
            document.getElementById('deleteName').textContent = name;
            document.getElementById('deleteForm').action = '/admin/terapeuti/' + id;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 z-50 flex overflow-y-auto bg-gray-900/40 p-4 hidden">
        <div class="m-auto w-full max-w-sm rounded-lg border border-gray-200 bg-white p-5 shadow-xl">
            <div>
                <h3 class="mb-4 text-base font-semibold text-gray-900">Delete Terapeut</h3>
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
</x-layouts.app>
