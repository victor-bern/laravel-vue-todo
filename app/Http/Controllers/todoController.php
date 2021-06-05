<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class todoController extends Controller
{
    public function doneOrUndoneTodo(Request $request, Todo $todo)
    {
        $todo->done = $request->value;
        $todo->save();

        return response()->json([
            "sucess" => true
        ]);
    }
}
