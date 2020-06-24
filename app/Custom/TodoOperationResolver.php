<?php

namespace App\Custom;

use Illuminate\Http\Request;
use App\Todo;
use App\TodoResource;
use App\Authentication\CurrentUser;
use App\Authentication\AuthException;

class TodoOperationResolver {
    public static function resolve(Request $request, Todo $todo, TodoOperation $operation) : TodoResource {
        $user_id = CurrentUser::getInstance()->getId();

        if($todo->owner_id !== $user_id) {
            throw new AuthException([
                "You don't have permissions for this operation"
            ]);
        }

        $operation->validateRequest($request);
        return $operation->performOperation($request, $todo);
    }
}

?>