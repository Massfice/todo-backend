<?php

namespace App\Custom;

use Illuminate\Http\Request;
use App\Todo;
use App\TodoResource;

class ToggleTodo implements TodoOperation {
    public function validateRequest(Request $request) {
        
    }

    public function performOperation(Request $request, Todo $todo) : TodoResource {
        $todo->checked = !$todo->checked;
        $todo->save();
        return new TodoResource($todo);
    }
}

?>