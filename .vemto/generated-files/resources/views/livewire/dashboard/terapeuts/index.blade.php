<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 space-y-4">
    <x-ui.breadcrumbs>
        <x-ui.breadcrumbs.link href="/dashboard"
            >Dashboard</x-ui.breadcrumbs.link
        >
        <x-ui.breadcrumbs.separator />
        <x-ui.breadcrumbs.link active
            >{{ __('crud.terapeuts.collectionTitle') }}</x-ui.breadcrumbs.link
        >
    </x-ui.breadcrumbs>

    <div class="flex justify-between align-top py-4">
        <x-ui.input
            wire:model.live="search"
            type="text"
            placeholder="Search {{ __('crud.terapeuts.collectionTitle') }}..."
        />

        @can('create', App\Models\Terapeut::class)
        <a wire:navigate href="{{ route('dashboard.terapeuts.create') }}">
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
                wire:click="delete({{ $deletingTerapeut }})"
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
                    >{{ __('crud.terapeuts.inputs.ime.label')
                    }}</x-ui.table.header
                >
                <x-ui.table.header for-crud wire:click="sortBy('prezime')"
                    >{{ __('crud.terapeuts.inputs.prezime.label')
                    }}</x-ui.table.header
                >
                <x-ui.table.header for-crud wire:click="sortBy('jmbg')"
                    >{{ __('crud.terapeuts.inputs.jmbg.label')
                    }}</x-ui.table.header
                >
                <x-ui.table.header for-crud wire:click="sortBy('broj_telefona')"
                    >{{ __('crud.terapeuts.inputs.broj_telefona.label')
                    }}</x-ui.table.header
                >
                <x-ui.table.header for-crud wire:click="sortBy('password_hash')"
                    >{{ __('crud.terapeuts.inputs.password_hash.label')
                    }}</x-ui.table.header
                >
                <x-ui.table.header for-crud wire:click="sortBy('username')"
                    >{{ __('crud.terapeuts.inputs.username.label')
                    }}</x-ui.table.header
                >
                <x-ui.table.action-header>Actions</x-ui.table.action-header>
            </x-slot>

            <x-slot name="body">
                @forelse ($terapeuts as $terapeut)
                <x-ui.table.row wire:loading.class.delay="opacity-75">
                    <x-ui.table.column for-crud
                        >{{ $terapeut->ime }}</x-ui.table.column
                    >
                    <x-ui.table.column for-crud
                        >{{ $terapeut->prezime }}</x-ui.table.column
                    >
                    <x-ui.table.column for-crud
                        >{{ $terapeut->jmbg }}</x-ui.table.column
                    >
                    <x-ui.table.column for-crud
                        >{{ $terapeut->broj_telefona }}</x-ui.table.column
                    >
                    <x-ui.table.column for-crud
                        >{{ $terapeut->password_hash }}</x-ui.table.column
                    >
                    <x-ui.table.column for-crud
                        >{{ $terapeut->username }}</x-ui.table.column
                    >
                    <x-ui.table.action-column>
                        @can('update', $terapeut)
                        <x-ui.action
                            wire:navigate
                            href="{{ route('dashboard.terapeuts.edit', $terapeut) }}"
                            >Edit</x-ui.action
                        >
                        @endcan @can('delete', $terapeut)
                        <x-ui.action.danger
                            wire:click="confirmDeletion({{ $terapeut->id }})"
                            >Delete</x-ui.action.danger
                        >
                        @endcan
                    </x-ui.table.action-column>
                </x-ui.table.row>
                @empty
                <x-ui.table.row>
                    <x-ui.table.column colspan="7"
                        >No {{ __('crud.terapeuts.collectionTitle') }} found.</x-ui.table.column
                    >
                </x-ui.table.row>
                @endforelse
            </x-slot>
        </x-ui.table>

        <div class="mt-2">{{ $terapeuts->links() }}</div>
    </x-ui.container.table>
</div>
