<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 space-y-4">
    <x-ui.breadcrumbs>
        <x-ui.breadcrumbs.link href="/dashboard"
            >Dashboard</x-ui.breadcrumbs.link
        >
        <x-ui.breadcrumbs.separator />
        <x-ui.breadcrumbs.link
            href="{{ route('dashboard.administrators.index') }}"
            >{{ __('crud.administrators.collectionTitle')
            }}</x-ui.breadcrumbs.link
        >
        <x-ui.breadcrumbs.separator />
        <x-ui.breadcrumbs.link active
            >Edit {{ __('crud.administrators.itemTitle')
            }}</x-ui.breadcrumbs.link
        >
    </x-ui.breadcrumbs>

    <x-ui.toast on="saved"> Administrator saved successfully. </x-ui.toast>

    <div class="w-full text-gray-500 text-lg font-semibold py-4 uppercase">
        <h1>Edit {{ __('crud.administrators.itemTitle') }}</h1>
    </div>

    <div class="overflow-hidden border rounded-lg bg-white">
        <form class="w-full mb-0" wire:submit.prevent="save">
            <div class="p-6 space-y-3">
                <div class="w-full">
                    <x-ui.label for="ime"
                        >{{ __('crud.administrators.inputs.ime.label')
                        }}</x-ui.label
                    >
                    <x-ui.input.text
                        class="w-full"
                        wire:model="form.ime"
                        name="ime"
                        id="ime"
                        placeholder="{{ __('crud.administrators.inputs.ime.placeholder') }}"
                    />
                    <x-ui.input.error for="form.ime" />
                </div>

                <div class="w-full">
                    <x-ui.label for="prezime"
                        >{{ __('crud.administrators.inputs.prezime.label')
                        }}</x-ui.label
                    >
                    <x-ui.input.text
                        class="w-full"
                        wire:model="form.prezime"
                        name="prezime"
                        id="prezime"
                        placeholder="{{ __('crud.administrators.inputs.prezime.placeholder') }}"
                    />
                    <x-ui.input.error for="form.prezime" />
                </div>

                <div class="w-full">
                    <x-ui.label for="godina_rodjenja"
                        >{{
                        __('crud.administrators.inputs.godina_rodjenja.label')
                        }}</x-ui.label
                    >
                    <x-ui.input.number
                        class="w-full"
                        wire:model="form.godina_rodjenja"
                        name="godina_rodjenja"
                        id="godina_rodjenja"
                        placeholder="{{ __('crud.administrators.inputs.godina_rodjenja.placeholder') }}"
                        step="1"
                    />
                    <x-ui.input.error for="form.godina_rodjenja" />
                </div>

                <div class="w-full">
                    <x-ui.label for="hash"
                        >{{ __('crud.administrators.inputs.hash.label')
                        }}</x-ui.label
                    >
                    <x-ui.input.text
                        class="w-full"
                        wire:model="form.hash"
                        name="hash"
                        id="hash"
                        placeholder="{{ __('crud.administrators.inputs.hash.placeholder') }}"
                    />
                    <x-ui.input.error for="form.hash" />
                </div>

                <div class="w-full">
                    <x-ui.label for="salt"
                        >{{ __('crud.administrators.inputs.salt.label')
                        }}</x-ui.label
                    >
                    <x-ui.input.text
                        class="w-full"
                        wire:model="form.salt"
                        name="salt"
                        id="salt"
                        placeholder="{{ __('crud.administrators.inputs.salt.placeholder') }}"
                    />
                    <x-ui.input.error for="form.salt" />
                </div>

                <div class="w-full">
                    <x-ui.label for="username"
                        >{{ __('crud.administrators.inputs.username.label')
                        }}</x-ui.label
                    >
                    <x-ui.input.text
                        class="w-full"
                        wire:model="form.username"
                        name="username"
                        id="username"
                        placeholder="{{ __('crud.administrators.inputs.username.placeholder') }}"
                    />
                    <x-ui.input.error for="form.username" />
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
