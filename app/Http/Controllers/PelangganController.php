<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelanggans = Pelanggan::paginate(5);
        return view('admin.pelanggan.index', compact('pelanggans'));
    }

    public function create()
    {
        return view('admin.pelanggan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);

        Pelanggan::create($request->all());
        return redirect()->route('admin.pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    public function edit(Pelanggan $pelanggan, $id_pelanggan)
    {
        $pelanggan = Pelanggan::findOrFail($id_pelanggan);
        return view('admin.pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, Pelanggan $pelanggan, $id_pelanggan)
    {
        try {
            // Ambil data pelanggan berdasarkan id
            $pelanggan = Pelanggan::find($id_pelanggan);
            if (!$pelanggan) {
                return redirect()->back()->withErrors('pelanggan tidak ditemukan.');
            }

            // Validasi input
            $validatedData = $request->validate([
                'nama' => 'required|max:255',
                'no_hp' => 'required|max:255',
                'alamat' => 'required|max:255',
            ]);


            // Update pelanggan
            $pelanggan->update($validatedData);

            \Log::info("pelanggan berhasil diperbarui: ", $pelanggan->toArray());

            return redirect()->route('admin.pelanggan.index')->with('success', 'pelanggan berhasil diperbarui.');
        } catch (\Exception $e) {
            \Log::error("Error saat memperbarui pelanggan: " . $e->getMessage());
            return redirect()->back()->withErrors('Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy(Pelanggan $pelanggan, $id_pelanggan)
    {
        $pelanggan = Pelanggan::findOrFail($id_pelanggan);
        $pelanggan->delete();
        return redirect()->route('admin.pelanggan.index')->with('success', 'Pelanggan berhasil dihapus.');
    }
}
