<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Expertise;

class StudentExpertise extends Component
{
    public $confirmingExpertiseView;

    public function confirmExpertiseView()
    {
        $this->confirmingExpertiseView = true;
    }

    public function viewExpertise($id)
    {
        // Retrieve expertise details for the selected supervisor_id
        $expertiseDetails = Expertise::where('supervisor_id', $id)->get();

        // Pass the data to the Livewire component property for use in the view
        $this->confirmingExpertiseView = $expertiseDetails;

        $this->confirmingExpertiseView = true;
    }

    public function confirmBookSupervisor()
    {

    }

    public function render()
    {
        $expertises = Expertise::with('supervisor')->get();

        return view('livewire.student-expertise', ['expertises' => $expertises]);
    }

}

