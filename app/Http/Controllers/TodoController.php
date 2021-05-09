<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller {

    //
    public function index()
    {
        return Todo::orderBy('status')->orderBy('created_at')->get();
    }

    //
    public function store()
    {
        $this->validateEntry();
        Todo::create([
            'task'        => request('task'),
            'description' => request('description'),
            'complete_by' => request('complete_by'),
        ]);
    }


    protected function validateEntry()
    {
        return request()->validate([
            'task'        => ['required', 'max:150'],
            'description' => ['max:2000'],
            'complete_by' => ['required', 'date_format:Y-m-d', 'after:yesterday'],
        ]);
    }

}
