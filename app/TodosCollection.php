<?php

namespace App;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Request;

class TodosCollection extends ResourceCollection {
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        $array = [];
        foreach($this->collection as $todo) {
            $array[] = new TodoResource($todo);
        }

        return $array;
    }
}

?>