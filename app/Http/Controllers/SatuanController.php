<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $satuans = Satuan::paginate(5);

        // Log data yang sudah dieksekusi (untuk debugging)
        // \Log::info('Data Satuan:',$satuans->toArray());
        return view('admin.satuan.index', compact('satuans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.satuan.create');
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    Log::info('Memulai proses penyimpanan satuan.', ['request' => $request->all()]);

    $request->validate([
        'nama' => 'required',
    ]);
    Log::info('Validasi berhasil.');

    $data = $request->all();
    Log::info('Data yang akan disimpan:', $data);

    Satuan::create($data);
    Log::info('Data berhasil disimpan ke database.');

    return redirect()->route('admin.satuan.index')->with('success', 'Barang berhasil ditambahkan.');
}

    /**
     * Display the specified resource.
     */
    public function show(Satuan $satuans)
    {
        return view('admin.satuan.show', compact('satuans'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_satuan)
{
    $satuans = Satuan::findOrFail($id_satuan);
    return view('admin.satuan.edit', compact('satuans'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_satuan)
{
    try {
        // Ambil data satuan berdasarkan id
       $satuans = Satuan::find($id_satuan);
        if (!$satuans) {
            return redirect()->back()->withErrors('satuan tidak ditemukan.');
        }

        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        // Proses upload gambar jika ada

        // Update satuan
       $satuans->update($validatedData);

        \Log::info("satuan berhasil diperbarui: ",$satuans->toArray());

        return redirect()->route('admin.satuan.index')->with('success', 'satuan berhasil diperbarui.');
    } catch (\Exception $e) {
        \Log::error("Error saat memperbarui satuan: " . $e->getMessage());
        return redirect()->back()->withErrors('Terjadi kesalahan: ' . $e->getMessage());
    }
}




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_satuan)
    {

        // \Log::info("ID Barang yang akan dihapus: " . $id_satuan);
        $satuans = Satuan::findOrFail($id_satuan);
        $satuans->delete();
        return redirect()->route('admin.satuan.index')->with('success', 'Barang berhasil dihapus.');
    }
}
