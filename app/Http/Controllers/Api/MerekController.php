<?php

namespace App\Http\Controllers\api;

use App\Models\Merek;
use Illuminate\Http\Request;
use App\Http\Resources\MerekResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class MerekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $merks = Merek::all();
        return MerekResource::collection($merks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        Merek::create($request->all());
        return response()->json(['message' => 'Merek created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $merek = Merek::find($id);

        if (!$merek) {
            return response()->json(['message' => 'Merek not found'], 404);
        }

        return new MerekResource($merek);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $merek = Merek::find($id);

        if (!$merek) {
            return response()->json(['message' => 'Merek not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $merek->update($request->all());
        return new MerekResource($merek);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $merek = Merek::find($id);

        if (!$merek) {
            return response()->json(['message' => 'Merek not found'], 404);
        }

        $merek->delete();
        return response()->json(['message' => 'Merek deleted successfully']);
    }
}

