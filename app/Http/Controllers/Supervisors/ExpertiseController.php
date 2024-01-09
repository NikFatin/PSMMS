<?php

namespace App\Http\Controllers\Supervisors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ExpertiseController extends Controller
{
    
    public function index()
    {
        if(Gate::denies('manage-expertise-student')) {
            abort(403);
        }
        return view('supervisor.expertises.index');
    }

    public function indexStudent()
    {

        if(Gate::denies('manage-expertise-student')){
            abort(403);
        }
        return view('student.expertises.viewExpertise');
    }
    
}
