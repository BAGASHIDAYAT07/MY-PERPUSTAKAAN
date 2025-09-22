@extends('template.app')

@section('konten')
    <h1 class="mt-4">Detail Peminjaman</h1>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-info-circle me-1"></i>
            Informasi Peminjaman
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>ID Peminjaman</th>
                </tr>
                <tr>
                    <th>Nama Peminjam</th>
                </tr>
                <tr>
                    <th>Judul Buku</th>
                </tr>
                <tr>
                    <th>Tanggal Pinjam</th>
                </tr>
                <tr>
                    <th>Tanggal Kembali</th>
                </tr>
                <tr>
                    <th>Status</th>
                </tr>
            </table>
        </div>
    </div>

@endsection
