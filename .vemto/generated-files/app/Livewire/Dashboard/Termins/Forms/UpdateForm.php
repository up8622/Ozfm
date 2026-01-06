<?php

namespace App\Livewire\Dashboard\Termins\Forms;

use Livewire\Form;
use App\Models\Termin;
use Illuminate\Validation\Rule;

class UpdateForm extends Form
{
    public ?Termin $termin;

    public $vreme = '';

    public $pacijent_id = '';

    public $terapeut_id = '';

    public $usluga_id = '';

    public function rules(): array
    {
        return [
            'vreme' => ['required', 'date'],
            'pacijent_id' => ['required'],
            'terapeut_id' => ['required'],
            'usluga_id' => ['required'],
        ];
    }

    public function setTermin(Termin $termin)
    {
        $this->termin = $termin;

        $this->vreme = $termin->vreme;
        $this->pacijent_id = $termin->pacijent_id;
        $this->terapeut_id = $termin->terapeut_id;
        $this->usluga_id = $termin->usluga_id;
    }

    public function save()
    {
        $this->validate();

        $this->termin->update($this->except(['termin']));
    }
}
