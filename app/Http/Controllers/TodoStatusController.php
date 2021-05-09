<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Validation\Rule;

class TodoStatusController extends Controller
{
    //
    public function update($id)
    {
        request()->validate([
            'status' => ['required', Rule::in([0, 1]), 'numeric'],
        ]);

        $todo = Todo::findOrFail($id);
        $todo->status = request('status');
        $todo->save();
    }
}
