<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Title;
use Livewire\WithPagination;

class SupervisorTitle extends Component
{
    use WithPagination;

    public $title, $description, $fullDescription;

    public $confirmingTitleDeletion = false;
    public $confirmingTitleAdd = false;
    public $confirmingAddEdit = false;
    public $selectedTitle = null;

    public function render()
    {
        // Retrieve the currently authenticated user's ID
        $supervisorId = auth()->user()->supervisor->id;

        $titles = Title::where('supervisor_id', $supervisorId)->paginate(10);
        return view('livewire.supervisor-title', [
            'titles' => $titles,
        ]);
    }

    public function confirmTitleDeletion($id)
    {
        $this->confirmingTitleDeletion = $id;
    }

    public function deleteTitle(Title $title){
        $title->delete();
        $this->confirmingTitleDeletion = false;
    }

    public function confirmTitleAdd()
    {
        $this->resetForm();
        $this->confirmingTitleAdd = true;
        $this->selectedTitle = null;
    }

    public function confirmTitleEdit(Title $title)
    {
        $this->selectedTitle = $title;

        $this->title = $title->title;
        $this->description = $title->description;

        $this->confirmingTitleAdd = true;
    }

    public function updateTitle()
    {
        if ($this->selectedTitle) {
            $this->selectedTitle->update([
                'titles' => $this->title,
                'description' => $this->description,
            ]);
        }

        $this->resetForm();
    }

    private function resetForm()
    {
        $this->title = '';
        $this->description = '';

        $this->confirmingTitleAdd = false;
    }

    public function saveTitle()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        if($this->selectedTitle) {
            $this->updateTitle();
        } else {
            $supervisor = auth()->user()->supervisor;
            $supervisor->titles()->create([
                'title' => $this->title,
                'description' => $this->description,
            ]);
        }
        $this->resetForm();
    }
    public function showFullDescription($fullDescription)
    {
        $this->fullDescription = $fullDescription;
        $this->dispatchBrowserEvent('showFullDescriptionModal'); // Trigger an event to open a modal or take any other action
    }


}
