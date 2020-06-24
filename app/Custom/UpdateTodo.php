<?php

namespace App\Custom;

use Illuminate\Http\Request;
use App\Todo;
use App\TodoResource;

class UpdateTodo implements TodoOperation {
    public function validateRequest(Request $request) {
        $request->validate([
            'text' => 'required',
            'checked' => 'required'
        ]);
    }

    public function fillData(Request $request, Todo $todo) : Todo {
        $data = $request->only($todo->getFillable());
        $todo->fill($data);
        return $todo;
    }

    public function performOperation(Request $request, Todo $todo) : TodoResource {
        $todo = $this->fillData($request, $todo);
        $todo->save();
        return new TodoResource($todo);
    }
}

?>