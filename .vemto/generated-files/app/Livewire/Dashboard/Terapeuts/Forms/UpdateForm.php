<?php

namespace App\Livewire\Dashboard\Terapeuts\Forms;

use Livewire\Form;
use App\Models\Terapeut;
use Illuminate\Validation\Rule;

class UpdateForm extends Form
{
    public ?Terapeut $terapeut;

    public $ime = '';

    public $prezime = '';

    public $jmbg = '';

    public $broj_telefona = '';

    public $password_hash = '';

    public $username = '';

    public function rules(): array
    {
        return [
            'ime' => ['required', 'string'],
            'prezime' => ['required', 'string'],
            'jmbg' => ['required', 'string'],
            'broj_telefona' => ['required', 'string'],
            'password_hash' => ['required', 'string'],
            'username' => ['required', 'string'],
        ];
    }

    public function setTerapeut(Terapeut $terapeut)
    {
        $this->terapeut = $terapeut;

        $this->ime = $terapeut->ime;
        $this->prezime = $terapeut->prezime;
        $this->jmbg = $terapeut->jmbg;
        $this->broj_telefona = $terapeut->broj_telefona;
        $this->password_hash = $terapeut->password_hash;
        $this->username = $terapeut->username;
    }

    public function save()
    {
        $this->validate();

        $this->terapeut->update($this->except(['terapeut']));
    }
}
