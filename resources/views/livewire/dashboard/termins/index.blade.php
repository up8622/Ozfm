<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 space-y-4">
    <x-ui.breadcrumbs>
        <x-ui.breadcrumbs.link href="/dashboard"
            >Dashboard</x-ui.breadcrumbs.link
        >
        <x-ui.breadcrumbs.separator />
        <x-ui.breadcrumbs.link active
            >{{ __('crud.termins.collectionTitle') }}</x-ui.breadcrumbs.link
        >
    </x-ui.breadcrumbs>

    <div class="flex justify-between align-top py-4">
        <x-ui.input
            wire:model.live="search"
            type="text"
            placeholder="Search {{ __('crud.termins.collectionTitle') }}..."
        />

        @can('create', App\Models\Termin::class)
        <a wire:navigate href="{{ route('dashboard.termins.create') }}">
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
                wire:click="delete({{ $deletingTermin }})"
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
                <x-ui.table.header for-crud wire:click="sortBy('vreme')"
                    >{{ __('crud.termins.inputs.vreme.label')
                    }}</x-ui.table.header
                >
                <x-ui.table.header for-crud wire:click="sortBy('pacijent_id')"
                    >{{ __('crud.termins.inputs.pacijent_id.label')
                    }}</x-ui.table.header
                >
                <x-ui.table.header for-crud wire:click="sortBy('terapeut_id')"
                    >{{ __('crud.termins.inputs.terapeut_id.label')
                    }}</x-ui.table.header
                >
                <x-ui.table.header for-crud wire:click="sortBy('usluga_id')"
                    >{{ __('crud.termins.inputs.usluga_id.label')
                    }}</x-ui.table.header
                >
                <x-ui.table.action-header>Actions</x-ui.table.action-header>
            </x-slot>

            <x-slot name="body">
                @forelse ($termins as $termin)
                <x-ui.table.row wire:loading.class.delay="opacity-75">
                    <x-ui.table.column for-crud
                        >{{ $termin->vreme }}</x-ui.table.column
                    >
                    <x-ui.table.column for-crud
                        >{{ $termin->pacijent_id }}</x-ui.table.column
                    >
                    <x-ui.table.column for-crud
                        >{{ $termin->terapeut_id }}</x-ui.table.column
                    >
                    <x-ui.table.column for-crud
                        >{{ $termin->usluga_id }}</x-ui.table.column
                    >
                    <x-ui.table.action-column>
                        @can('update', $termin)
                        <x-ui.action
                            wire:navigate
                            href="{{ route('dashboard.termins.edit', $termin) }}"
                            >Edit</x-ui.action
                        >
                        @endcan @can('delete', $termin)
                        <x-ui.action.danger
                            wire:click="confirmDeletion({{ $termin->id }})"
                            >Delete</x-ui.action.danger
                        >
                        @endcan
                    </x-ui.table.action-column>
                </x-ui.table.row>
                @empty
                <x-ui.table.row>
                    <x-ui.table.column colspan="5"
                        >No {{ __('crud.termins.collectionTitle') }} found.</x-ui.table.column
                    >
                </x-ui.table.row>
                @endforelse
            </x-slot>
        </x-ui.table>

        <div class="mt-2">{{ $termins->links() }}</div>
    </x-ui.container.table>
</div>
