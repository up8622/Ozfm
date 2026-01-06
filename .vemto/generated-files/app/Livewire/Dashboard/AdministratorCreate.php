<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Collection;
use App\Livewire\Dashboard\Administrators\Forms\CreateForm;

class AdministratorCreate extends Component
{
    use WithFileUploads;

    public CreateForm $form;

    public function mount()
    {
    }

    public function save()
    {
        $this->authorize('create', Administrator::class);

        $this->validate();

        $administrator = $this->form->save();

        return redirect()->route(
            'dashboard.administrators.edit',
            $administrator
        );
    }

    public function render()
    {
        return view('livewire.dashboard.administrators.create', []);
    }
}
