@extends('layouts.app')

@section('title', 'Create Barang')

@section('content')
    <div class="container-sm mt-5">
        <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-center">
                <div class="p-5 bg-light rounded-3 border col-xl-6">
                    <div class="mb-3 text-center">
                        <i class="bi-box me-2" style="font-size: 60px;"></i>
                        <h4>Tambahkan Barang</h4>
                    </div>
                    <hr>
                    <div class="row">
                        <!-- Nama Mahasiswa -->
                        <div class="col-md-6 mb-3">
                            <label for="nama_mahasiswa" class="form-label">Nama Mahasiswa</label>
                            <input class="form-control @error('nama_mahasiswa') is-invalid @enderror" type="text"
                                name="nama_mahasiswa" id="nama_mahasiswa" value="{{ old('nama_mahasiswa') }}" placeholder="Enter Nama Mahasiswa">
                            @error('nama_mahasiswa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Prodi -->
                        <div class="col-md-6 mb-3">
                            <label for="prodi" class="form-label">Prodi</label>
                            <input class="form-control @error('prodi') is-invalid @enderror" type="text"
                                name="prodi" id="prodi" value="{{ old('prodi') }}" placeholder="Enter Prodi">
                            @error('prodi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Barang Pinjam -->
                        <div class="col-md-6 mb-3">
                            <label for="barang_pinjam" class="form-label">Barang Pinjam</label>
                            <input class="form-control @error('barang_pinjam') is-invalid @enderror" type="text"
                                name="barang_pinjam" id="barang_pinjam" value="{{ old('barang_pinjam') }}" placeholder="Enter Barang Pinjam">
                            @error('barang_pinjam')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tanggal Pinjam -->
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
                            <input class="form-control @error('tanggal_pinjam') is-invalid @enderror" type="date"
                                name="tanggal_pinjam" id="tanggal_pinjam" value="{{ old('tanggal_pinjam') }}" placeholder="Enter Tanggal Pinjam">
                            @error('tanggal_pinjam')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tanggal Kembali -->
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                            <input class="form-control @error('tanggal_kembali') is-invalid @enderror" type="date"
                                name="tanggal_kembali" id="tanggal_kembali" value="{{ old('tanggal_kembali') }}" placeholder="Enter Tanggal Kembali">
                            @error('tanggal_kembali')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Foto Barang -->
                        <div class="col-md-12 mb-3">
                            <label for="foto_barang" class="form-label">Foto Barang</label>
                            <input type="file" class="form-control @error('foto_barang') is-invalid @enderror" name="foto_barang" id="foto_barang">
                            @error('foto_barang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 d-grid">
                            <a href="{{ route('barang.index') }}" class="btn btn-outline-dark btn-lg mt-3">
                                <i class="bi-arrow-left-circle me-2"></i> Cancel
                            </a>
                        </div>
                        <div class="col-md-6 d-grid">
                            <button type="submit" class="btn btn-dark btn-lg mt-3">
                                <i class="bi-check-circle me-2"></i> Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
