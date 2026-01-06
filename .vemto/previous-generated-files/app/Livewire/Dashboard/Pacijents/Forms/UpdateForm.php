<?php

namespace App\Livewire\Dashboard\Pacijents\Forms;

use Livewire\Form;
use App\Models\Pacijent;
use Illuminate\Validation\Rule;

class UpdateForm extends Form
{
    public ?Pacijent $pacijent;

    public $ime = '';

    public $prezime = '';

    public $godina_rodjenja = '';

    public $broj_telefona = '';

    public $password_hash = '';

    public $username = '';

    public function rules(): array
    {
        return [
            'ime' => ['required', 'string'],
            'prezime' => ['required', 'string'],
            'godina_rodjenja' => ['required'],
            'broj_telefona' => ['required', 'string'],
            'password_hash' => ['required', 'string'],
            'username' => ['required', 'string'],
        ];
    }

    public function setPacijent(Pacijent $pacijent)
    {
        $this->pacijent = $pacijent;

        $this->ime = $pacijent->ime;
        $this->prezime = $pacijent->prezime;
        $this->godina_rodjenja = $pacijent->godina_rodjenja;
        $this->broj_telefona = $pacijent->broj_telefona;
        $this->password_hash = $pacijent->password_hash;
        $this->username = $pacijent->username;
    }

    public function save()
    {
        $this->validate();

        $this->pacijent->update($this->except(['pacijent']));
    }
}
