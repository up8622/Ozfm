<?php

namespace App\Livewire\Dashboard;

use App\Models\Termin;
use Livewire\Component;
use Livewire\WithPagination;

class TerminIndex extends Component
{
    use WithPagination;

    public $search;
    public $sortField = 'updated_at';
    public $sortDirection = 'desc';

    public $queryString = ['search', 'sortField', 'sortDirection'];

    public $confirmingDeletion = false;
    public $deletingTermin;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDeletion(string $id)
    {
        $this->deletingTermin = $id;

        $this->confirmingDeletion = true;
    }

    public function delete(Termin $termin)
    {
        $termin->delete();

        $this->confirmingDeletion = false;
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection =
                $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate(5);
    }

    public function getRowsQueryProperty()
    {
        return Termin::query()
            ->orderBy($this->sortField, $this->sortDirection)
            ->where('created_at', 'like', "%{$this->search}%");
    }

    public function render()
    {
        return view('livewire.dashboard.termins.index', [
            'termins' => $this->rows,
        ]);
    }
}
