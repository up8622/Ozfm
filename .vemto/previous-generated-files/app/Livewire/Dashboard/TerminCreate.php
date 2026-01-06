<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Collection;
use App\Livewire\Dashboard\Termins\Forms\CreateForm;

class TerminCreate extends Component
{
    use WithFileUploads;

    public CreateForm $form;

    public function mount()
    {
    }

    public function save()
    {
        $this->authorize('create', Termin::class);

        $this->validate();

        $termin = $this->form->save();

        return redirect()->route('dashboard.termins.edit', $termin);
    }

    public function render()
    {
        return view('livewire.dashboard.termins.create', []);
    }
}
