<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Expertise;
use Livewire\WithPagination;

class Expertises extends Component
{
    use WithPagination;

    public $expertise, $description, $level;

    public $confirmingExpertiseDeletion = false;
    public $confirmingExpertiseAdd = false;
    public $confirmingExpertiseEdit = false;
    public $selectedExpertise = null;

    public function render()
    {
        // Retrieve the currently authenticated user's ID
        $supervisorId = auth()->user()->supervisor->id;

        // Fetch expertises based on the supervisor_id
        $expertises = Expertise::where('supervisor_id', $supervisorId)->paginate(10);

        return view('livewire.expertises', [
            'expertises' => $expertises,
        ]);

    }

    public function confirmExpertiseDeletion($id)
    {
        $this->confirmingExpertiseDeletion = $id;
    }

    public function deleteExpertise(Expertise $expertise){
        $expertise->delete();
        $this->confirmingExpertiseDeletion = false;
    }

    public function confirmExpertiseAdd()
    {
        $this->resetForm();
        $this->confirmingExpertiseAdd = true;
        $this->selectedExpertise = null;
    }

    public function confirmExpertiseEdit(Expertise $expertise)
    {
        // set the selected expertise
        $this->selectedExpertise = $expertise;

        //populate form fields with existing data
        $this->expertise = $expertise->expertise;
        $this->description = $expertise->description;
        $this->level = $expertise->level;

        //set the flag for confirming expertise edit
        $this->confirmingExpertiseAdd = true;
    }

    public function updateExpertise()
    {
        //update the existing expertise with the edited data
        if ($this->selectedExpertise) {
            $this->selectedExpertise->update([
                'expertise' => $this->expertise,
                'description' => $this->description,
                'level' => $this->level,
            ]);
        }

        //reser the form fields and confirmation flag
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->expertise = '';
        $this->description = '';
        $this->level = '';

        $this->confirmingExpertiseAdd = false;
    }

    public function saveExpertise()
    {
        //validate
        $this->validate([
            'expertise' => 'required|string|max:255',
            'description' => 'required|string',
            'level' => 'required|string|max:255',
        ]);

        if($this->selectedExpertise) {
            // Update existing expertise
            $this->updateExpertise();
        } else {
            // Create new expertise
            $supervisor = auth()->user()->supervisor;
            $supervisor->expertises()->create([
                'expertise' => $this->expertise,
                'description' => $this->description,
                'level' => $this->level,
            ]);
        }
        //Reset form fields and confirmation flag
        $this->resetForm();
    }

}