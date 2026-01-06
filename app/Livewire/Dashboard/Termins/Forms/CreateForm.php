<?php

namespace App\Livewire\Dashboard\Termins\Forms;

use Livewire\Form;
use App\Models\Termin;
use Livewire\Attributes\Rule;

class CreateForm extends Form
{
    #[Rule('required|date')]
    public $vreme = '';

    #[Rule('required')]
    public $pacijent_id = '';

    #[Rule('required')]
    public $terapeut_id = '';

    #[Rule('required')]
    public $usluga_id = '';

    public function save()
    {
        $this->validate();

        $termin = Termin::create($this->except([]));

        $this->reset();

        return $termin;
    }
}
