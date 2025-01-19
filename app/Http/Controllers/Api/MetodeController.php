<?php

namespace App\Http\Controllers\api;

use App\Models\MetodeBayar;
use Illuminate\Http\Request;
use App\Http\Resources\MetodeResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class MetodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $metodes = MetodeBayar::all();
        return MetodeResource::collection($metodes);
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

        MetodeBayar::create($request->all());
        return response()->json(['message' => 'Metode created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $metode = MetodeBayar::find($id);

        if (!$metode) {
            return response()->json(['message' => 'Metode not found'], 404);
        }

        return new MetodeResource($metode);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $metode = MetodeBayar::find($id);

        if (!$metode) {
            return response()->json(['message' => 'Metode not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $metode->update($request->all());
        return new MetodeResource($metode);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $metode = MetodeBayar::find($id);

        if (!$metode) {
            return response()->json(['message' => 'Metode not found'], 404);
        }

        $metode->delete();
        return response()->json(['message' => 'Metode deleted successfully']);
    }
}

