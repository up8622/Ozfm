<?php

namespace App\Livewire\Dashboard\Administrators\Forms;

use Livewire\Form;
use Livewire\Attributes\Rule;
use App\Models\Administrator;

class CreateForm extends Form
{
    #[Rule('required|string')]
    public $ime = '';

    #[Rule('required|string')]
    public $prezime = '';

    #[Rule('required')]
    public $godina_rodjenja = '';

    #[Rule('required|string')]
    public $hash = '';

    #[Rule('required|string')]
    public $salt = '';

    #[Rule('required|string')]
    public $username = '';

    public function save()
    {
        $this->validate();

        $administrator = Administrator::create($this->except([]));

        $this->reset();

        return $administrator;
    }
}
