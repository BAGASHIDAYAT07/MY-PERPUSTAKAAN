@extends('template.app')

@section("konten")
<h1 class="mt-4">Daftar Buku</h1>

<div class="card mb-4">
    <div class="card-header">
        <a href="" class="btn btn-primary">Tambah Buku</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Jenis Buku</th>
                    <th>Penerbit</th>
                    <th>Pencipta</th>
                    <th>Tempat Terbit</th>
                    <th>Tahun Terbit</th>
                    <th>Jumlah Halaman</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                       
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus buku?')">Hapus</button>
                      
                    </td>
                </tr>
               
            </tbody>
        </table>
    </div>
</div>
@endsection
