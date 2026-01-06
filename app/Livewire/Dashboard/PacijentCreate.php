<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Collection;
use App\Livewire\Dashboard\Pacijents\Forms\CreateForm;

class PacijentCreate extends Component
{
    use WithFileUploads;

    public CreateForm $form;

    public function mount()
    {
    }

    public function save()
    {
        $this->authorize('create', Pacijent::class);

        $this->validate();

        $pacijent = $this->form->save();

        return redirect()->route('dashboard.pacijents.edit', $pacijent);
    }

    public function render()
    {
        return view('livewire.dashboard.pacijents.create', []);
    }
}
