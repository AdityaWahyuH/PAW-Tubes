<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    // Menampilkan daftar barang
    public function index()
    {
        $barangs = Barang::all();
        $pageTitle = 'List Barang';

        return view('barang.index', compact('barangs', 'pageTitle'));
    }

    // Menampilkan form tambah barang
    public function create()
    {
        return view('barang.create');
    }

    // Menyimpan data barang baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_mahasiswa' => 'required|string|max:255',
            'prodi'          => 'required|string|max:255',
            'barang_pinjam'  => 'required|string|max:255',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'nullable|date',
        ]);

        Barang::create($request->all());

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan');
    }

    // Menampilkan form edit barang
    public function edit(Barang $barang)
    {
        return view('barang.edit', compact('barang'));
    }

    // Memperbarui data barang
    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_mahasiswa' => 'required|string|max:255',
            'prodi'          => 'required|string|max:255',
            'barang_pinjam'  => 'required|string|max:255',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'nullable|date',
        ]);

        $barang->update($request->all());

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui');
    }

    // Menghapus data barang
    public function destroy(Barang $barang)
    {
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
    }
}
