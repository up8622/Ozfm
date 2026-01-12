<x-layouts.app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Terapeuti') }}</h2>
            <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="openAddModal()">
                Dodaj terapeuta
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ime</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prezime</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telefon</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($terapeuti as $terapeut)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $terapeut->ime }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $terapeut->prezime }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $terapeut->broj_telefona }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $terapeut->username }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button type="button" class="text-blue-600 hover:text-blue-900" onclick="editTerapeut({{ $terapeut->id }}, '{{ $terapeut->ime }}', '{{ $terapeut->prezime }}', '{{ $terapeut->jmbg }}', '{{ $terapeut->broj_telefona }}', '{{ $terapeut->username }}')">
                                    Edit
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="px-6 py-4" colspan="5">No terapeuti found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="terapeutModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 id="modalTitle" class="text-lg font-medium text-gray-900 mb-4">Add New Terapeut</h3>
                <form id="terapeutForm" action="{{ route('terapeuti.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" id="methodField" value="POST">
                    <input type="hidden" name="terapeut_id" id="terapeutId">
                    <div class="mb-4">
                        <label for="ime" class="block text-sm font-medium text-gray-700">Ime</label>
                        <input type="text" name="ime" id="ime" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="prezime" class="block text-sm font-medium text-gray-700">Prezime</label>
                        <input type="text" name="prezime" id="prezime" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="jmbg" class="block text-sm font-medium text-gray-700">JMBG</label>
                        <input type="text" name="jmbg" id="jmbg" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="broj_telefona" class="block text-sm font-medium text-gray-700">Broj Telefona</label>
                        <input type="text" name="broj_telefona" id="broj_telefona" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                        <input type="text" name="username" id="username" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" name="password" id="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <small class="text-gray-500">Leave blank to keep current password</small>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="mr-3 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded" onclick="closeModal()">Cancel</button>
                        <button type="submit" id="submitButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Terapeut</button>
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
            document.getElementById('terapeutModal').classList.remove('hidden');
        }

        function editTerapeut(id, ime, prezime, jmbg, broj_telefona, username) {
            document.getElementById('modalTitle').textContent = 'Edit Terapeut';
            document.getElementById('terapeutForm').action = '/terapeuti/' + id;
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
            document.getElementById('terapeutModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('terapeutModal').classList.add('hidden');
        }
    </script>
</x-layouts.app>
