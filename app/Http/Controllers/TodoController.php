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

    //
    public function show($id)
    {
        return Todo::findOrFail($id);
    }

    //
    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();
    }

    //
    public function update($id)
    {
        $this->validateEntry();
        $todo = Todo::findOrFail($id);
        $todo->task = request('task');
        $todo->description = request('description');
        $todo->complete_by = request('complete_by');
        $todo->save();
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
