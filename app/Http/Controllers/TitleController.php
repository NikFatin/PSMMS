<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TitleController extends Controller
{
    public function index()
    {
        if(Gate::denies('manage-title-sv')) {
            abort(403);
        }
        return view('supervisor.titles.index');

    }
}
