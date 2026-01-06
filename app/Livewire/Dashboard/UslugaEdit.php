<?php

namespace App\Livewire\Dashboard;

use App\Models\Usluga;
use Livewire\Component;
use Illuminate\Support\Collection;
use App\Livewire\Dashboard\Uslugas\Forms\UpdateForm;

class UslugaEdit extends Component
{
    public ?Usluga $usluga = null;

    public UpdateForm $form;

    public function mount(Usluga $usluga)
    {
        $this->authorize('view-any', Usluga::class);

        $this->usluga = $usluga;

        $this->form->setUsluga($usluga);
    }

    public function save()
    {
        $this->authorize('update', $this->usluga);

        $this->validate();

        $this->form->save();

        $this->dispatch('saved');
    }

    public function render()
    {
        return view('livewire.dashboard.uslugas.edit', []);
    }
}
