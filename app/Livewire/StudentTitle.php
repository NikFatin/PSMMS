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

    public function requestTitle()
    {
        // Assuming you have a property to store the selected title_id
        $selectedTitleId = $this->selectedTitleId;

        // Validate if the title_id is selected
        if (!$selectedTitleId) {
            // You can handle this case as needed, e.g., show an error message
            $this->addError('selectedTitleId', 'Please select a title before saving.');
            return;
        }

        // Assuming you have a property to store the student_id
        $studentId = auth()->user()->student->id; // Adjust this based on your authentication setup

        // Create a new request record
        Request::create([
            'student_id' => $studentId,
            'title_id' => $selectedTitleId,
            'supervisor_id' => null, // Since this is a title request, you can set supervisor_id to null
        ]);

        // Clear any previous errors (if any)
        $this->resetErrorBag();

        // Optionally, you can perform additional logic or show a success message

        // Reset any necessary properties after the request is saved
        $this->selectedTitleId = null; // Reset the selected title_id

        // Emit an event to notify other components (if needed)
        $this->emit('titleRequested');

        // Optionally, you can redirect the user or perform other actions
        // return redirect()->to('/dashboard');
    }



    public function render()
    {
        return view('livewire.student-title');
    }
}
