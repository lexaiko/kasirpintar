<?php

namespace App\Http\Controllers;
use App\Models\Pelanggan;
use App\Models\Kategori;
use App\Models\User;
use App\Models\MetodeBayar;
use Illuminate\Http\Request;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with(['pelanggan', 'user', 'metodeBayar'])->latest()->paginate(5);
        return view('admin.transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        $user = User::all();
        $metode = MetodeBayar::all();
        $pelanggan = Pelanggan::all();
        return view('admin.transaksi.create', compact('kategori', 'user', 'metode', 'pelanggan'));
    }

    public function store(Request $request)
    {
        dd($request->all());
        $request->validate([
            'id_pelanggan' => 'required|max:255',
            'id_staff' => 'required|max:255',
            'id_metode' => 'required|max:255',
            'total_belanja' => 'required|numeric|min:0',
        ]);

        Transaksi::create($request->all());
        return redirect()->route('admin.transaksi.index')->with('success', 'transaksi berhasil ditambahkan.');
    }

    public function edit(Transaksi $transaksi, $id_transaksi)
    {
        $transaksi = Transaksi::findOrFail($id_transaksi);
        $kategori = Kategori::all();
        $user = User::all();
        $metode = MetodeBayar::all();
        $pelanggan = Pelanggan::all();
        return view('admin.transaksi.edit', compact('transaksi','kategori', 'user', 'metode', 'pelanggan'));
    }

    public function update(Request $request, Transaksi $transaksi, $id_transaksi)
    {
        try {
            // Ambil data transaksi berdasarkan id
            $transaksi = Transaksi::find($id_transaksi);
            if (!$transaksi) {
                return redirect()->back()->withErrors('transaksi tidak ditemukan.');
            }

            // Validasi input
            $validatedData = $request->validate([
                'id_pelanggan' => 'required|max:255',
                'id_staff' => 'required|max:255',
                'id_metode' => 'required|max:255',
                'total_belanja' => 'required|numeric|min:0',
            ]);


            // Update transaksi
            $transaksi->update($validatedData);

            \Log::info("transaksi berhasil diperbarui: ", $transaksi->toArray());

            return redirect()->route('admin.transaksi.index')->with('success', 'transaksi berhasil diperbarui.');
        } catch (\Exception $e) {
            \Log::error("Error saat memperbarui transaksi: " . $e->getMessage());
            return redirect()->back()->withErrors('Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy(Transaksi $transaksi, $id_transaksi)
    {
        $transaksi = Transaksi::findOrFail($id_transaksi);
        $transaksi->delete();
        return redirect()->route('admin.transaksi.index')->with('success', 'transaksi berhasil dihapus.');
    }


}
