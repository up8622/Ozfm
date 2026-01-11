<?php

namespace App\Livewire\Dashboard\Administrators;

use Livewire\Component;
use App\Livewire\Dashboard\Administrators\Forms\CreateForm;

class Create extends Component
{
    public CreateForm $form;

    public function save()
    {
        $this->form->save();

        return redirect()->route('dashboard.administrators.index');
    }

    public function render()
    {
        return view('livewire.dashboard.administrators.create');
    }
}
