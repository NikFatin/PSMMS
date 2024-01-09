<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Title;
use App\Models\Request;

class StudentTitle extends Component
{
    public $titles, $selectedTitleId, $selectedTitle, $selectedDescription;

    public $confirmingShowFullDescription = false;
    public function mount()
    {
        $this->titles = Title::all();
    }

    public function showFullDescription($id)
    {
        $title = Title::findOrFail($id);
        $this->selectedTitleId = $id;
        $this->selectedTitle = $title->title;
        $this->selectedDescription = $title->description;

        // If the description is short, show it directly in the table
        if (str_word_count($title->description) <= 20) {
            $this->confirmingShowFullDescription = false;
        } else {
            // If the description is long, open the modal
            $this->confirmingShowFullDescription = true;
        }
    }

    public function requestTitle($id)
    {
        Request::create([
            'student_id' => auth()->user()->id,
            'title_id' => $id,
        ]);

        $this->emit('refreshComponent');
    }


    public function render()
    {
        return view('livewire.student-title');
    }
}
