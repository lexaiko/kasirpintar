<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaksi;

class Struk extends Component
{
    public $id_transaksi;

    public function mount($id_transaksi)
    {
        $this->id_transaksi = $id_transaksi;
    }

    public function render()
    {
        $transaksi = Transaksi::with(['pelanggan', 'metodeBayar', 'detailTransaksi.produk'])->findOrFail($this->id_transaksi);

        $struk = str_pad("", 40, "-", STR_PAD_BOTH) . "\n";
        $struk .= str_pad("ID Transaksi: {$transaksi->id_transaksi}", 40, " ", STR_PAD_BOTH) . "\n";
        $struk .= str_pad("Tanggal: {$transaksi->created_at->format('d-m-Y H:i')}", 40, " ", STR_PAD_BOTH) . "\n";
        $struk .= str_pad("Pelanggan: {$transaksi->pelanggan->nama}", 40, " ", STR_PAD_BOTH) . "\n";
        $struk .= str_pad("Metode Pembayaran: {$transaksi->metodeBayar->nama}", 40, " ", STR_PAD_BOTH) . "\n";
        $struk .= str_pad("", 40, "-", STR_PAD_BOTH) . "\n";

        foreach ($transaksi->detailTransaksi as $detail) {
            $struk .= str_pad("{$detail->produk->nama} ({$detail->jumlah} x Rp.{$detail->harga_satuan})", 40, " ", STR_PAD_BOTH) . "\n";
            $struk .= str_pad("Rp.{$detail->total_harga}", 40, " ", STR_PAD_BOTH) . "\n";
        }

        $struk .= str_pad("", 40, "-", STR_PAD_BOTH) . "\n";
        $struk .= str_pad("Total: Rp.{$transaksi->total_belanja}", 40, " ", STR_PAD_BOTH) . "\n";
        $struk .= str_pad("", 40, "-", STR_PAD_BOTH) . "\n";

        return view('livewire.struk', ['struk' => '<div style="text-align: center;">' . nl2br($struk) . '</div>']);
    }
}

