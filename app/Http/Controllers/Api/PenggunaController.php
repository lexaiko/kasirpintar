<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PenggunaResource;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengguna = User::all();
        return PenggunaResource::collection($pengguna);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'roles' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        User::create($request->all());
        return response()->json(['message' => 'Pengguna created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pengguna = User::find($id);

        if (!$pengguna) {
            return response()->json(['message' => 'Pengguna not found'], 404);
        }

        return new PenggunaResource($pengguna);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pengguna = User::find($id);

        if (!$pengguna) {
            return response()->json(['message' => 'Pengguna not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'roles' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $pengguna->update($request->all());
        return new PenggunaResource($pengguna);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pengguna = User::find($id);

        if (!$pengguna) {
            return response()->json(['message' => 'Pengguna not found'], 404);
        }

        $pengguna->delete();
        return response()->json(['message' => 'Pengguna deleted successfully']);
    }
}

