@extends('layouts.app')

@section('title', 'List Barang')

@section('content')
    <div class="container mt-4">
        <div class="row mb-0">
            <div class="col-lg-9 col-xl-10">
                <h4 class="mb-3">{{ $pageTitle }}</h4>
            </div>
            <div class="col-lg-3 col-xl-2">
                <div class="d-grid gap-2">
                    <a href="{{ route('barang.create') }}" class="btn btn-primary btn-sm" style="background-color: #92b906;">                        <i class="bi-plus-circle me-2"></i> Tambahkan Barang
                    </a>
                </div>
            </div>
        </div>
        <hr>

        <div class="table-responsive border p-3 rounded-3">
            <table class="table table-bordered table-hover table-striped mb-0 bg-white">
                <thead>
                    <tr>
                        <th>Nama Mahasiswa</th>
                        <th>Prodi</th>
                        <th>Barang Pinjam</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barangs as $barang)
                        <tr>
                            <td>{{ $barang->nama_mahasiswa }}</td>
                            <td>{{ $barang->prodi }}</td>
                            <td>{{ $barang->barang_pinjam }}</td>
                            <td>{{ $barang->tanggal_pinjam }}</td>
                            <td>{{ $barang->tanggal_kembali }}</td>
                            <td>
                                <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
