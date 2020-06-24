<?php

namespace App\Custom;

use Illuminate\Http\Request;
use App\Todo;
use App\TodoResource;

class DeleteTodo implements TodoOperation {
    public function validateRequest(Request $request) {
        
    }

    public function performOperation(Request $request, Todo $todo) : TodoResource {
        $todo->delete();
        return new TodoResource($todo);
    }
}

?>