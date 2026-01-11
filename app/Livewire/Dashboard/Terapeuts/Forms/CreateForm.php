<?php

namespace App\Livewire\Dashboard\Terapeuts\Forms;

use Livewire\Form;
use App\Models\Terapeut;
use Livewire\Attributes\Rule;

class CreateForm extends Form
{
    #[Rule('required|string')]
    public $ime = '';

    #[Rule('required|string')]
    public $prezime = '';

    #[Rule('required|string')]
    public $jmbg = '';

    #[Rule('required|string')]
    public $broj_telefona = '';

    #[Rule('required|string')]
    public $password_hash = '';

    #[Rule('required|string')]
    public $username = '';

    public function save()
    {
        $this->validate();

        $data['password_hash'] = Hash::make($this->password_hash);
        $terapeut = Terapeut::create($this->except([]));

        $this->reset();

        return $terapeut;
    }
}
