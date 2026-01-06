<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Terapeut;
use Illuminate\Support\Collection;
use App\Livewire\Dashboard\Terapeuts\Forms\UpdateForm;

class TerapeutEdit extends Component
{
    public ?Terapeut $terapeut = null;

    public UpdateForm $form;

    public function mount(Terapeut $terapeut)
    {
        $this->authorize('view-any', Terapeut::class);

        $this->terapeut = $terapeut;

        $this->form->setTerapeut($terapeut);
    }

    public function save()
    {
        $this->authorize('update', $this->terapeut);

        $this->validate();

        $this->form->save();

        $this->dispatch('saved');
    }

    public function render()
    {
        return view('livewire.dashboard.terapeuts.edit', []);
    }
}
