<?php

namespace App\Livewire\Dashboard\Pacijents\Forms;

use Livewire\Form;
use App\Models\Pacijent;
use Livewire\Attributes\Rule;

class CreateForm extends Form
{
    #[Rule('required|string')]
    public $ime = '';

    #[Rule('required|string')]
    public $prezime = '';

    #[Rule('required')]
    public $godina_rodjenja = '';

    #[Rule('required|string')]
    public $broj_telefona = '';

    #[Rule('required|string')]
    public $password_hash = '';

    #[Rule('required|string')]
    public $username = '';

    public function save()
    {
        $this->validate();

        $pacijent = Pacijent::create($this->except([]));

        $this->reset();

        return $pacijent;
    }
}
