<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTreeRequest;
// use App\Http\Requests\UpdateTreeStatusRequest;
use Illuminate\Http\Request;

use App\Http\Resources\TreeResource;
use App\Models\Tree;

class TreeController extends Controller
{

    public function index()
    {

        // Get All Todos.

        $trees = Tree::All();
        
        return TreeResource::collection($trees);
    }


    public function create()
    {
        //
    }


    public function store(StoreTreeRequest $request)
    {
        //create Todo.

        $trees = Tree::create($request->all());

        return new TreeResource($trees);
    }

    
    public function show($id)
    {
        // show Tree by user

        $tree = Tree::where('user_id', $id)->get();

        return TreeResource::collection($tree);
    }



    public function edit(Tree $tree)
    {
        //
    }


    public function update(StoreTreeRequest $request, Tree $tree)
    {
        // Edit Tree.

        $tree->update($request->all());

        return new TreeResource($tree);
    }


    public function destroy(Tree $tree)
    {
        // delete Tree.

        $tree->delete();

        return response(null, 204);
    }

    public function currentTree($id) 
    {
        // Show current tree

        $tree = Tree::where('id', $id)->get();

        return TreeResource::collection($tree);
    }

    // change tree status

    public function changeStatus(Request $request, $id,  Tree $tree){

        $this->validate($request, [
            'active' => 'required',
        ]);

        $tree = Tree::findorfail($id);

        $tree->active = $request->active;

        $tree->save();

        return response()->json($tree);

   
    }
}
