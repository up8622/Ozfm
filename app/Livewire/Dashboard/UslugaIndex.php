<?php

namespace App\Livewire\Dashboard;

use App\Models\Usluga;
use Livewire\Component;
use Livewire\WithPagination;

class UslugaIndex extends Component
{
    use WithPagination;

    public $search;
    public $sortField = 'updated_at';
    public $sortDirection = 'desc';

    public $queryString = ['search', 'sortField', 'sortDirection'];

    public $confirmingDeletion = false;
    public $deletingUsluga;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDeletion(string $id)
    {
        $this->deletingUsluga = $id;

        $this->confirmingDeletion = true;
    }

    public function delete(Usluga $usluga)
    {
        $usluga->delete();

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
        return Usluga::query()
            ->orderBy($this->sortField, $this->sortDirection)
            ->where('naziv', 'like', "%{$this->search}%");
    }

    public function render()
    {
        return view('livewire.dashboard.uslugas.index', [
            'uslugas' => $this->rows,
        ]);
    }
}
