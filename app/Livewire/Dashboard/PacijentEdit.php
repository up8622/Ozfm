<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Pacijent;
use Illuminate\Support\Collection;
use App\Livewire\Dashboard\Pacijents\Forms\UpdateForm;

class PacijentEdit extends Component
{
    public ?Pacijent $pacijent = null;

    public UpdateForm $form;

    public function mount(Pacijent $pacijent)
    {
        $this->authorize('view-any', Pacijent::class);

        $this->pacijent = $pacijent;

        $this->form->setPacijent($pacijent);
    }

    public function save()
    {
        $this->authorize('update', $this->pacijent);

        $this->validate();

        $this->form->save();

        $this->dispatch('saved');
    }

    public function render()
    {
        return view('livewire.dashboard.pacijents.edit', []);
    }
}
