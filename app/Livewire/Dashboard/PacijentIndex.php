<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Pacijent;
use Livewire\WithPagination;

class PacijentIndex extends Component
{
    use WithPagination;

    public $search;
    public $sortField = 'updated_at';
    public $sortDirection = 'desc';

    public $queryString = ['search', 'sortField', 'sortDirection'];

    public $confirmingDeletion = false;
    public $deletingPacijent;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDeletion(string $id)
    {
        $this->deletingPacijent = $id;

        $this->confirmingDeletion = true;
    }

    public function delete(Pacijent $pacijent)
    {
        $pacijent->delete();

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
        return Pacijent::query()
            ->orderBy($this->sortField, $this->sortDirection)
            ->where('ime', 'like', "%{$this->search}%");
    }

    public function render()
    {
        return view('livewire.dashboard.pacijents.index', [
            'pacijents' => $this->rows,
        ]);
    }
}
