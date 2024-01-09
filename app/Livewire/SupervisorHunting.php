<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Supervisor;
use App\Models\Request;

class SupervisorHunting extends Component
{
    public $selectedSupervisorId;
    public function render()
    {
        $supervisors = Supervisor::with('user')->get();

        return view('livewire.supervisor-hunting', compact('supervisors'));
    }

    public function requestSupervisor()
    {
        // Assuming you have a property to store the selected supervisor_id
        $selectedSupervisorId = $this->selectedSupervisorId;

        // Validate if the supervisor_id is selected
        if (!$selectedSupervisorId) {
            // You can handle this case as needed, e.g., show an error message
            $this->addError('selectedSupervisorId', 'Please select a supervisor before saving.');
            return;
        }

        // Assuming you have a property to store the student_id
        $studentId = auth()->user()->student->id; // Adjust this based on your authentication setup

        // Create a new request record
        Request::create([
            'student_id' => $studentId,
            'supervisor_id' => $selectedSupervisorId,
            'title_id' => null, // Since this is a supervisor request, you can set title_id to null
        ]);

        // Clear any previous errors (if any)
        $this->resetErrorBag();

        // Optionally, you can perform additional logic or show a success message

        // Reset any necessary properties after the request is saved
        $this->selectedSupervisorId = null; // Reset the selected supervisor_id

        // Emit an event to notify other components (if needed)
        $this->emit('supervisorRequested');

        // Optionally, you can redirect the user or perform other actions
        // return redirect()->to('/dashboard');
    }
}