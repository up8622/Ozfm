<?php

namespace App\Livewire\Dashboard\Uslugas\Forms;

use Livewire\Form;
use App\Models\Usluga;
use Livewire\Attributes\Rule;

class CreateForm extends Form
{
    #[Rule('required|string')]
    public $naziv = '';

    #[Rule('required')]
    public $cena = '';

    public function save()
    {
        $this->validate();

        $usluga = Usluga::create($this->except([]));

        $this->reset();

        return $usluga;
    }
}
