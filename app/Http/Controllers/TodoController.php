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
}
