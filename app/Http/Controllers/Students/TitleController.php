<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class TitleController extends Controller
{
    public function index()
    {
        if(Gate::denies('manage-title-student')) {
            abort(403);
        }
        return view('student.titles.viewTitle');

    }
}
