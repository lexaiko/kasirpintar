<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PenggunaResource;
use App\Models\User;


class PenggunaController extends Controller
{
    public function index()
    {
            $pengguna = User::all();
            return PenggunaResource::collection($pengguna);
    }
}
