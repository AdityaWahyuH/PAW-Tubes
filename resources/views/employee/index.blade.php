@extends('layouts.app')

@section('title', 'List Employee')

@section('content')
    <div class="container mt-4">
        <div class="row mb-0">
            <div class="col-lg-9 col-xl-10">
                <h4 class="mb-3">{{ $pageTitle }}</h4>
            </div>
            <div class="col-lg-3 col-xl-2">
                <div class="d-grid gap-2">
                    <a href="{{ route('employees.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi-plus-circle me-2"></i> Tambahkan Barang
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
                    @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $employee->namaMahasiswa }}</td>
                            <td>{{ $employee->prodi }}</td>
                            <td>{{ $employee->barangPinjam }}</td>
                            <td>{{ $employee->tanggalPinjam }}</td>
                            <td>{{ $employee->position->name }}</td>
                            <td>@include('employee.actions')</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
