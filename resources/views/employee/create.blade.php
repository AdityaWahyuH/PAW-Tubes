@extends('layouts.app')

@section('title', 'Create Employee')

@section('content')
    <div class="container-sm mt-5">
        <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-center">
                <div class="p-5 bg-light rounded-3 border col-xl-6">
                    <div class="mb-3 text-center">
                        <i class="bi-box me-2" style="font-size: 60px;"></i></a>
                        <h4>Tambahkan Barang</h4>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="namaMahasiswa" class="form-label">Nama Mahasiswa</label>
                            <input class="form-control @error('namaMahasiswa') is-invalid @enderror" type="text" name="firstName" id="firstName" value="{{ old('firstName') }}" placeholder="Enter First Name">
                            @error('namaMahasiswa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="prodi" class="form-label">Prodi</label>
                            <input class="form-control @error('prodi') is-invalid @enderror" type="text" name="lastName" id="lastName" value="{{ old('lastName') }}" placeholder="Enter Last Name">
                            @error('prodi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="barangPinjam" class="form-label">Email</label>
                            <input class="form-control @error('barangPinjam') is-invalid @enderror" type="text" name="email" id="email" value="{{ old('email') }}" placeholder="Enter Email">
                            @error('barangPinjam')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tanggalPinjam" class="form-label">Tanggal Pinjam</label>
                            <input class="form-control @error('tanggalPinjam') is-invalid @enderror" type="text" name="age" id="age" value="{{ old('age') }}" placeholder="Enter Age">
                            @error('tanggalPinjam')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="tanggalKembali" class="form-label">Tanggal Kembalikan Barang</label>
                            <select name="position" id="position" class="form-select @error('position') is-invalid @enderror">
                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}" {{ old('position') == $position->id ? 'selected' : '' }}>{{ $position->name }}</option>
                                @endforeach
                            </select>
                            @error('position')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input untuk upload CV -->
                        <div class="col-md-12 mb-3">
                            <label for="cv" class="form-label">Foto Barang</label>
                            <input type="file" class="form-control @error('cv') is-invalid @enderror" name="cv" id="cv">
                            @error('cv')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 d-grid">
                            <a href="{{ route('employees.index') }}" class="btn btn-outline-dark btn-lg mt-3">
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
