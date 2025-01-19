<?php

namespace App\Http\Controllers\api;

use App\Models\Satuan;
use Illuminate\Http\Request;
use App\Http\Resources\SatuanResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $satuan = Satuan::all();
        return SatuanResource::collection($satuan);
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

        Satuan::create($request->all());
        return response()->json(['message' => 'Satuan created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $satuan = Satuan::find($id);

        if (!$satuan) {
            return response()->json(['message' => 'Satuan not found'], 404);
        }

        return new SatuanResource($satuan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $satuan = Satuan::find($id);

        if (!$satuan) {
            return response()->json(['message' => 'Satuan not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $satuan->update($request->all());
        return new SatuanResource($satuan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $satuan = Satuan::find($id);

        if (!$satuan) {
            return response()->json(['message' => 'Satuan not found'], 404);
        }

        $satuan->delete();
        return response()->json(['message' => 'Satuan deleted successfully']);
    }
}

