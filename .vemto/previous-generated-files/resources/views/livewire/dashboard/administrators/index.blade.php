<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 space-y-4">
    <x-ui.breadcrumbs>
        <x-ui.breadcrumbs.link href="/dashboard"
            >Dashboard</x-ui.breadcrumbs.link
        >
        <x-ui.breadcrumbs.separator />
        <x-ui.breadcrumbs.link active
            >{{ __('crud.administrators.collectionTitle')
            }}</x-ui.breadcrumbs.link
        >
    </x-ui.breadcrumbs>

    <div class="flex justify-between align-top py-4">
        <x-ui.input
            wire:model.live="search"
            type="text"
            placeholder="Search {{ __('crud.administrators.collectionTitle') }}..."
        />

        @can('create', App\Models\Administrator::class)
        <a wire:navigate href="{{ route('dashboard.administrators.create') }}">
            <x-ui.button>New</x-ui.button>
        </a>
        @endcan
    </div>

    {{-- Delete Modal --}}
    <x-ui.modal.confirm wire:model="confirmingDeletion">
        <x-slot name="title"> {{ __('Delete') }} </x-slot>

        <x-slot name="content"> {{ __('Are you sure?') }} </x-slot>

        <x-slot name="footer">
            <x-ui.button
                wire:click="$toggle('confirmingDeletion')"
                wire:loading.attr="disabled"
            >
                {{ __('Cancel') }}
            </x-ui.button>

            <x-ui.button.danger
                class="ml-3"
                wire:click="delete({{ $deletingAdministrator }})"
                wire:loading.attr="disabled"
            >
                {{ __('Delete') }}
            </x-ui.button.danger>
        </x-slot>
    </x-ui.modal.confirm>

    {{-- Index Table --}}
    <x-ui.container.table>
        <x-ui.table>
            <x-slot name="head">
                <x-ui.table.header for-crud wire:click="sortBy('ime')"
                    >{{ __('crud.administrators.inputs.ime.label')
                    }}</x-ui.table.header
                >
                <x-ui.table.header for-crud wire:click="sortBy('prezime')"
                    >{{ __('crud.administrators.inputs.prezime.label')
                    }}</x-ui.table.header
                >
                <x-ui.table.header
                    for-crud
                    wire:click="sortBy('godina_rodjenja')"
                    >{{ __('crud.administrators.inputs.godina_rodjenja.label')
                    }}</x-ui.table.header
                >
                <x-ui.table.header for-crud wire:click="sortBy('hash')"
                    >{{ __('crud.administrators.inputs.hash.label')
                    }}</x-ui.table.header
                >
                <x-ui.table.header for-crud wire:click="sortBy('salt')"
                    >{{ __('crud.administrators.inputs.salt.label')
                    }}</x-ui.table.header
                >
                <x-ui.table.header for-crud wire:click="sortBy('username')"
                    >{{ __('crud.administrators.inputs.username.label')
                    }}</x-ui.table.header
                >
                <x-ui.table.action-header>Actions</x-ui.table.action-header>
            </x-slot>

            <x-slot name="body">
                @forelse ($administrators as $administrator)
                <x-ui.table.row wire:loading.class.delay="opacity-75">
                    <x-ui.table.column for-crud
                        >{{ $administrator->ime }}</x-ui.table.column
                    >
                    <x-ui.table.column for-crud
                        >{{ $administrator->prezime }}</x-ui.table.column
                    >
                    <x-ui.table.column for-crud
                        >{{ $administrator->godina_rodjenja
                        }}</x-ui.table.column
                    >
                    <x-ui.table.column for-crud
                        >{{ $administrator->hash }}</x-ui.table.column
                    >
                    <x-ui.table.column for-crud
                        >{{ $administrator->salt }}</x-ui.table.column
                    >
                    <x-ui.table.column for-crud
                        >{{ $administrator->username }}</x-ui.table.column
                    >
                    <x-ui.table.action-column>
                        @can('update', $administrator)
                        <x-ui.action
                            wire:navigate
                            href="{{ route('dashboard.administrators.edit', $administrator) }}"
                            >Edit</x-ui.action
                        >
                        @endcan @can('delete', $administrator)
                        <x-ui.action.danger
                            wire:click="confirmDeletion({{ $administrator->id }})"
                            >Delete</x-ui.action.danger
                        >
                        @endcan
                    </x-ui.table.action-column>
                </x-ui.table.row>
                @empty
                <x-ui.table.row>
                    <x-ui.table.column colspan="7"
                        >No {{ __('crud.administrators.collectionTitle') }} found.</x-ui.table.column
                    >
                </x-ui.table.row>
                @endforelse
            </x-slot>
        </x-ui.table>

        <div class="mt-2">{{ $administrators->links() }}</div>
    </x-ui.container.table>
</div>
