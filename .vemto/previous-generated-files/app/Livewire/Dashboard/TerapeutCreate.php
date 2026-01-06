<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Collection;
use App\Livewire\Dashboard\Terapeuts\Forms\CreateForm;

class TerapeutCreate extends Component
{
    use WithFileUploads;

    public CreateForm $form;

    public function mount()
    {
    }

    public function save()
    {
        $this->authorize('create', Terapeut::class);

        $this->validate();

        $terapeut = $this->form->save();

        return redirect()->route('dashboard.terapeuts.edit', $terapeut);
    }

    public function render()
    {
        return view('livewire.dashboard.terapeuts.create', []);
    }
}
