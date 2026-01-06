<?php

namespace App\Livewire\Dashboard\Uslugas\Forms;

use Livewire\Form;
use App\Models\Usluga;
use Illuminate\Validation\Rule;

class UpdateForm extends Form
{
    public ?Usluga $usluga;

    public $naziv = '';

    public $cena = '';

    public function rules(): array
    {
        return [
            'naziv' => ['required', 'string'],
            'cena' => ['required'],
        ];
    }

    public function setUsluga(Usluga $usluga)
    {
        $this->usluga = $usluga;

        $this->naziv = $usluga->naziv;
        $this->cena = $usluga->cena;
    }

    public function save()
    {
        $this->validate();

        $this->usluga->update($this->except(['usluga']));
    }
}
