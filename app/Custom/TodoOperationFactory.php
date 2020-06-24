<?php

namespace App\Custom;

use Illuminate\Http\Request;

class TodoOperationFactory {
    public static function create(Request $request) : TodoOperation {
        $method = strtolower($request->method());
        
        switch($method) {
            case "put":
                return new UpdateTodo();
            case "patch":
                return new ToggleTodo();
            case "delete":
                return new DeleteTodo();
        }
    }
}

?>