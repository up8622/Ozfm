<?php

namespace App\Livewire\Dashboard;

use App\Models\Termin;
use Livewire\Component;
use Illuminate\Support\Collection;
use App\Livewire\Dashboard\Termins\Forms\UpdateForm;

class TerminEdit extends Component
{
    public ?Termin $termin = null;

    public UpdateForm $form;

    public function mount(Termin $termin)
    {
        $this->authorize('view-any', Termin::class);

        $this->termin = $termin;

        $this->form->setTermin($termin);
    }

    public function save()
    {
        $this->authorize('update', $this->termin);

        $this->validate();

        $this->form->save();

        $this->dispatch('saved');
    }

    public function render()
    {
        return view('livewire.dashboard.termins.edit', []);
    }
}
