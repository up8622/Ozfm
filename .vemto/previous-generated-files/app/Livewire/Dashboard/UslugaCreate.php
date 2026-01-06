<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Collection;
use App\Livewire\Dashboard\Uslugas\Forms\CreateForm;

class UslugaCreate extends Component
{
    use WithFileUploads;

    public CreateForm $form;

    public function mount()
    {
    }

    public function save()
    {
        $this->authorize('create', Usluga::class);

        $this->validate();

        $usluga = $this->form->save();

        return redirect()->route('dashboard.uslugas.edit', $usluga);
    }

    public function render()
    {
        return view('livewire.dashboard.uslugas.create', []);
    }
}
