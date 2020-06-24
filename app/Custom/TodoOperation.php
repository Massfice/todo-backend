<?php

namespace App\Custom;

use Illuminate\Http\Request;
use App\Todo;
use App\TodoResource;

interface TodoOperation {
    public function validateRequest(Request $request);
    public function performOperation(Request $request, Todo $todo) : TodoResource;
}

?>