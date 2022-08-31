<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Http\Resources\TodoResource;
use Illuminate\Http\Request;

use App\Models\Todo;

class TodoController extends Controller
{

    public function index()
    {
        // Get All todos,
        
        $todos = Todo::All();

        return TodoResource::collection($todos);
    }


    public function create()
    {
        //
    }


    public function store(StoreTodoRequest $request)
    {
        // Create Todo.

        $todos = Todo::create($request->all());

        return new TodoResource($todos);
    }


    public function show($id)
    {
        // Get Todos by Resolution.

        $todo = Todo::where('resolution_id', $id)->get();

        return response()->json($todo);
    }


    public function edit(Todo $todo)
    {
        //
    }


    public function update(StoreTodoRequest $request, Todo $todo)
    {
        // Edit Todo.

        $todo->update($request->all());

        return new TodoResource($todo);
    }

    public function destroy(Todo $todo)
    {   
        // Detelete Todo.
        
        $todo->delete();

        return response(null, 204);
    }
    public function changeStatus(Request $request, $id,  Todo $todo){

        $this->validate($request, [
            'checked' => 'required',
        ]);

        $todo = Todo::findorfail($id);

        $todo->checked = $request->checked;

        $todo->save();

        return response()->json($todo);

   
    }
}
