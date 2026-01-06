<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Administrator;
use Illuminate\Support\Collection;
use App\Livewire\Dashboard\Administrators\Forms\UpdateForm;

class AdministratorEdit extends Component
{
    public ?Administrator $administrator = null;

    public UpdateForm $form;

    public function mount(Administrator $administrator)
    {
        $this->authorize('view-any', Administrator::class);

        $this->administrator = $administrator;

        $this->form->setAdministrator($administrator);
    }

    public function save()
    {
        $this->authorize('update', $this->administrator);

        $this->validate();

        $this->form->save();

        $this->dispatch('saved');
    }

    public function render()
    {
        return view('livewire.dashboard.administrators.edit', []);
    }
}
