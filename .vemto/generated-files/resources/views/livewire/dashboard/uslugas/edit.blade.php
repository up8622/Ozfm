<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 space-y-4">
    <x-ui.breadcrumbs>
        <x-ui.breadcrumbs.link href="/dashboard"
            >Dashboard</x-ui.breadcrumbs.link
        >
        <x-ui.breadcrumbs.separator />
        <x-ui.breadcrumbs.link href="{{ route('dashboard.uslugas.index') }}"
            >{{ __('crud.uslugas.collectionTitle') }}</x-ui.breadcrumbs.link
        >
        <x-ui.breadcrumbs.separator />
        <x-ui.breadcrumbs.link active
            >Edit {{ __('crud.uslugas.itemTitle') }}</x-ui.breadcrumbs.link
        >
    </x-ui.breadcrumbs>

    <x-ui.toast on="saved"> Usluga saved successfully. </x-ui.toast>

    <div class="w-full text-gray-500 text-lg font-semibold py-4 uppercase">
        <h1>Edit {{ __('crud.uslugas.itemTitle') }}</h1>
    </div>

    <div class="overflow-hidden border rounded-lg bg-white">
        <form class="w-full mb-0" wire:submit.prevent="save">
            <div class="p-6 space-y-3">
                <div class="w-full">
                    <x-ui.label for="naziv"
                        >{{ __('crud.uslugas.inputs.naziv.label') }}</x-ui.label
                    >
                    <x-ui.input.text
                        class="w-full"
                        wire:model="form.naziv"
                        name="naziv"
                        id="naziv"
                        placeholder="{{ __('crud.uslugas.inputs.naziv.placeholder') }}"
                    />
                    <x-ui.input.error for="form.naziv" />
                </div>

                <div class="w-full">
                    <x-ui.label for="cena"
                        >{{ __('crud.uslugas.inputs.cena.label') }}</x-ui.label
                    >
                    <x-ui.input.number
                        class="w-full"
                        wire:model="form.cena"
                        name="cena"
                        id="cena"
                        placeholder="{{ __('crud.uslugas.inputs.cena.placeholder') }}"
                        step="1"
                    />
                    <x-ui.input.error for="form.cena" />
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
