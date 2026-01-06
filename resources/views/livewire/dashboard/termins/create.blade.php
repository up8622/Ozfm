<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 space-y-4">
    <x-ui.breadcrumbs>
        <x-ui.breadcrumbs.link href="/dashboard"
            >Dashboard</x-ui.breadcrumbs.link
        >
        <x-ui.breadcrumbs.separator />
        <x-ui.breadcrumbs.link href="{{ route('dashboard.termins.index') }}"
            >{{ __('crud.termins.collectionTitle') }}</x-ui.breadcrumbs.link
        >
        <x-ui.breadcrumbs.separator />
        <x-ui.breadcrumbs.link active
            >Create {{ __('crud.termins.itemTitle') }}</x-ui.breadcrumbs.link
        >
    </x-ui.breadcrumbs>

    <div class="w-full text-gray-500 text-lg font-semibold py-4 uppercase">
        <h1>Create {{ __('crud.termins.itemTitle') }}</h1>
    </div>

    <div class="overflow-hidden border rounded-lg bg-white">
        <form class="w-full mb-0" wire:submit.prevent="save">
            <div class="p-6 space-y-3">
                <div class="w-full">
                    <x-ui.label for="vreme"
                        >{{ __('crud.termins.inputs.vreme.label') }}</x-ui.label
                    >
                    <x-ui.input.date-time
                        class="w-full"
                        wire:model="form.vreme"
                        name="vreme"
                        id="vreme"
                    />
                    <x-ui.input.error for="form.vreme" />
                </div>

                <div class="w-full">
                    <x-ui.label for="pacijent_id"
                        >{{ __('crud.termins.inputs.pacijent_id.label')
                        }}</x-ui.label
                    >
                    <x-ui.input.number
                        class="w-full"
                        wire:model="form.pacijent_id"
                        name="pacijent_id"
                        id="pacijent_id"
                        placeholder="{{ __('crud.termins.inputs.pacijent_id.placeholder') }}"
                        step="1"
                    />
                    <x-ui.input.error for="form.pacijent_id" />
                </div>

                <div class="w-full">
                    <x-ui.label for="terapeut_id"
                        >{{ __('crud.termins.inputs.terapeut_id.label')
                        }}</x-ui.label
                    >
                    <x-ui.input.number
                        class="w-full"
                        wire:model="form.terapeut_id"
                        name="terapeut_id"
                        id="terapeut_id"
                        placeholder="{{ __('crud.termins.inputs.terapeut_id.placeholder') }}"
                        step="1"
                    />
                    <x-ui.input.error for="form.terapeut_id" />
                </div>

                <div class="w-full">
                    <x-ui.label for="usluga_id"
                        >{{ __('crud.termins.inputs.usluga_id.label')
                        }}</x-ui.label
                    >
                    <x-ui.input.number
                        class="w-full"
                        wire:model="form.usluga_id"
                        name="usluga_id"
                        id="usluga_id"
                        placeholder="{{ __('crud.termins.inputs.usluga_id.placeholder') }}"
                        step="1"
                    />
                    <x-ui.input.error for="form.usluga_id" />
                </div>
            </div>

            <div class="flex justify-between mt-4 border-t border-gray-50 p-4">
                <div>
                    <!-- Other buttons here -->
                </div>
                <div>
                    <x-ui.button type="submit">Save</x-ui.button>
                </div>
            </div>
        </form>
    </div>
</div>
