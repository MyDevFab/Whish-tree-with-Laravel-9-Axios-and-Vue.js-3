<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResolutionRequest;
use App\Http\Resources\ResolutionResource;
use Illuminate\Http\Request;


use App\Models\Resolution;

class ResolutionController extends Controller
{

    public function index()
    {
        //show all Resolutions.
        
        $resolutions = Resolution::All();

        return  ResolutionResource::collection($resolutions);

    }

    public function create()
    {
        //
    }


    public function store(StoreResolutionRequest $request)
    {
        // Create a Resolution.

        $resolutions = Resolution::create($request->all());

        return new ResolutionResource($resolutions);
    }


    public function show($id)
    {
        // Show a Resolution by Tree.

        $resolution = Resolution::where('tree_id', $id)->get();

        return response()->json($resolution);
    }

    public function edit(Resolution $resolution)
    {
        //
    }


    public function update(StoreResolutionRequest $request, Resolution $resolution)
    {
        // Edit a Resolution.

        $resolution->update($request->all());

        return new ResolutionResource($resolution);
    }


    public function destroy(Resolution $resolution)
    {
        // Delete a resolution.

        $resolution->delete();

        return response(null, 204);
    }

    public function changeStatus(Request $request, $id,  Resolution $resolution)
    {

        $this->validate($request, ['checked' => 'required']);

        $resolution = Resolution::findorfail($id);

        $resolution->checked = $request->checked;

        $resolution->save();

        return response()->json($resolution);

   
    }
    

    public function changeTree(Request $request, $id,  Resolution $resolution)
    {

        $this->validate($request, ['tree_id' => 'required']);
        $this->validate($request, ['checked' => 'required']);

        $resolution = Resolution::findorfail($id);

        $resolution->tree_id = $request->tree_id;
        $resolution->checked = $request->checked;

        $resolution->save();

        return response()->json($resolution);

   
    }

    public function putOnHold(Request $request, $id,  Resolution $resolution)
    {

        $this->validate($request, ['onhold' => 'required']);
      

        $resolution = Resolution::findorfail($id);

        $resolution->onhold = $request->onhold;
        

        $resolution->save();

        return response()->json($resolution);

   
    }

    public function currentResolution($id)
    {
        $resolution = Resolution::where('id', $id)->get();

        return response()->json($resolution);
    }
}
