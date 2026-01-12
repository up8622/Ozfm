<x-layouts.app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Usluge') }}</h2>
            <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="openAddModal()">
                Dodaj uslugu
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Naziv</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cena</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($usluge as $usluga)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $usluga->naziv }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $usluga->cena }} RSD</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button type="button" class="text-blue-600 hover:text-blue-900 mr-2" onclick="editUsluga({{ $usluga->id }}, '{{ $usluga->naziv }}', {{ $usluga->cena }})">
                                    Edit
                                </button>
                                <button type="button" class="text-red-600 hover:text-red-900" onclick="confirmDelete({{ $usluga->id }}, '{{ $usluga->naziv }}')">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="px-6 py-4" colspan="3">No usluge found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="uslugaModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 id="modalTitle" class="text-lg font-medium text-gray-900 mb-4">Add New Usluga</h3>
                <form id="uslugaForm" action="{{ route('usluga.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" id="methodField" value="POST">
                    <input type="hidden" name="usluga_id" id="uslugaId">
                    <div class="mb-4">
                        <label for="naziv" class="block text-sm font-medium text-gray-700">Naziv</label>
                        <input type="text" name="naziv" id="naziv" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="cena" class="block text-sm font-medium text-gray-700">Cena (RSD)</label>
                        <input type="number" step="0.01" name="cena" id="cena" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="mr-3 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded" onclick="closeModal()">Cancel</button>
                        <button type="submit" id="submitButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Usluga</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Delete Usluga</h3>
                <p class="text-sm text-gray-500 mb-4">Are you sure you want to delete <span id="deleteName"></span>? This action cannot be undone.</p>
                <form id="deleteForm" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="flex justify-end">
                        <button type="button" class="mr-3 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded" onclick="closeDeleteModal()">Cancel</button>
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
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