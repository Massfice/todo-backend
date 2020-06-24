<?php

namespace App\Http\Controllers;

use App\Todo;
use App\TodosCollection;
use App\TodoResource;
use Illuminate\Http\Request;
use App\Authentication\CurrentUser;

use App\Custom\TodoOperationFactory;
use App\Custom\TodoOperationResolver;
use App\Custom\UpdateTodo;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Todo::where('owner_id',CurrentUser::getInstance()->getId())->get();
        return response(new TodosCollection($todos),200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $operation = new UpdateTodo();
        
        $operation->validateRequest($request);
        $todo = $operation->fillData($request, new Todo());
        $todo->owner_id = CurrentUser::getInstance()->getId();
        $todo->save();
        
        return new TodoResource($todo);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        $operation = TodoOperationFactory::create($request);
        return TodoOperationResolver::resolve($request, $todo, $operation);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Todo $todo)
    {
        $operation = TodoOperationFactory::create($request);
        return TodoOperationResolver::resolve($request, $todo, $operation);
    }
}
