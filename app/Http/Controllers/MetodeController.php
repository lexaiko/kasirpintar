<?php

namespace App\Http\Controllers;
use App\Models\MetodeBayar;
use Illuminate\Http\Request;

class MetodeController extends Controller
    {
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            $metodes = MetodeBayar::paginate(10); // Correct way


            // Log data yang sudah dieksekusi (untuk debugging)
            // \Log::info('Data metode:', $metodes->toArray());
            return view('admin.metode.index', compact('metodes'));
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            return view('admin.metode.create');
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

            MetodeBayar::create($data);
            return redirect()->route('admin.metode.index')->with('success', 'Metode Pembayaran berhasil ditambahkan.');
        }

        /**
         * Display the specified resource.
         */
        public function show(MetodeBayar $metode)
        {
            return view('admin.metode.show');
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit($id_metode)
    {
        $metode = MetodeBayar::findOrFail($id_metode);
        return view('admin.metode.edit', compact('metode'));
    }

        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request, $id_metode)
    {
        try {
            // Ambil data metode berdasarkan id
            $metode = MetodeBayar::find($id_metode);
            if (!$metode) {
                return redirect()->back()->withErrors('metode tidak ditemukan.');
            }

            // Validasi input
            $validatedData = $request->validate([
                'nama' => 'required|max:255',
            ]);


            // Update metode
            $metode->update($validatedData);

            \Log::info("metode berhasil diperbarui: ", $metode->toArray());

            return redirect()->route('admin.metode.index')->with('success', 'metode berhasil diperbarui.');
        } catch (\Exception $e) {
            \Log::error("Error saat memperbarui metode: " . $e->getMessage());
            return redirect()->back()->withErrors('Terjadi kesalahan: ' . $e->getMessage());
        }
    }




        /**
         * Remove the specified resource from storage.
         */
        public function destroy($id_metode)
        {

            // \Log::info("ID Barang yang akan dihapus: " . $id_metode);
            $metode = MetodeBayar::findOrFail($id_metode);
            $metode->delete();
            return redirect()->route('admin.metode.index')->with('success', 'metode berhasil dihapus.');
        }
}
