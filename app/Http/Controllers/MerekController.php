<?php

namespace App\Http\Controllers;

use App\Models\Merek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class MerekController extends Controller
    {
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            $mereks = Merek::paginate(10); // Correct way


            // Log data yang sudah dieksekusi (untuk debugging)
            // \Log::info('Data merek:', $mereks->toArray());
            return view('admin.merek.index', compact('mereks'));
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            return view('admin.merek.create');
        }



        /**
         * Store a newly created resource in storage.
         */
        public function store(Request $request)
        {

            $request->validate([
                'nama' => 'required|max:255',
            ]);
            $data = $request->all();

            Merek::create($data);
            return redirect()->route('admin.merek.index')->with('success', 'Merek berhasil ditambahkan.');
        }

        /**
         * Display the specified resource.
         */
        public function show(Merek $merek)
        {
            return view('admin.merek.show');
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit($id_merek)
    {
        $merek = Merek::findOrFail($id_merek);
        return view('admin.merek.edit', compact('merek'));
    }

        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request, $id_merek)
    {
        try {
            // Ambil data merek berdasarkan id
            $merek = Merek::find($id_merek);
            if (!$merek) {
                return redirect()->back()->withErrors('merek tidak ditemukan.');
            }

            // Validasi input
            $validatedData = $request->validate([
                'nama' => 'required|max:255',
            ]);


            // Update merek
            $merek->update($validatedData);

            \Log::info("merek berhasil diperbarui: ", $merek->toArray());

            return redirect()->route('admin.merek.index')->with('success', 'merek berhasil diperbarui.');
        } catch (\Exception $e) {
            \Log::error("Error saat memperbarui merek: " . $e->getMessage());
            return redirect()->back()->withErrors('Terjadi kesalahan: ' . $e->getMessage());
        }
    }




        /**
         * Remove the specified resource from storage.
         */
        public function destroy($id_merek)
        {

            // \Log::info("ID Barang yang akan dihapus: " . $id_merek);
            $merek = Merek::findOrFail($id_merek);
            $merek->delete();
            return redirect()->route('admin.merek.index')->with('success', 'Merek berhasil dihapus.');
        }
}
