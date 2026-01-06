<?php

namespace App\Livewire\Dashboard\Administrators\Forms;

use Livewire\Form;
use App\Models\Administrator;
use Illuminate\Validation\Rule;

class UpdateForm extends Form
{
    public ?Administrator $administrator;

    public $ime = '';

    public $prezime = '';

    public $godina_rodjenja = '';

    public $hash = '';

    public $salt = '';

    public $username = '';

    public function rules(): array
    {
        return [
            'ime' => ['required', 'string'],
            'prezime' => ['required', 'string'],
            'godina_rodjenja' => ['required'],
            'hash' => ['required', 'string'],
            'salt' => ['required', 'string'],
            'username' => ['required', 'string'],
        ];
    }

    public function setAdministrator(Administrator $administrator)
    {
        $this->administrator = $administrator;

        $this->ime = $administrator->ime;
        $this->prezime = $administrator->prezime;
        $this->godina_rodjenja = $administrator->godina_rodjenja;
        $this->hash = $administrator->hash;
        $this->salt = $administrator->salt;
        $this->username = $administrator->username;
    }

    public function save()
    {
        $this->validate();

        $this->administrator->update($this->except(['administrator']));
    }
}
