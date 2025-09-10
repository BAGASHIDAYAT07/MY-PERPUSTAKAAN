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
                <!-- @foreach ($buku as $item) -->
                <tr>
                    <td>{{ $item->judul }}</td>
                    <td>{{ $item->jenis_buku }}</td>
                    <td>{{ $item->penerbit }}</td>
                    <td>{{ $item->pencipta }}</td>
                    <td>{{ $item->tempat_terbit }}</td>
                    <td>{{ $item->tahun_terbit }}</td>
                    <td>{{ $item->jumlah_halaman }}</td>
                    <td>
                        <!-- <a href="{{ route('buku.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a> -->
                        <!-- <form action="{{ route('buku.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE') -->
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus buku?')">Hapus</button>
                        <!-- </form> -->
                    </td>
                </tr>
                <!-- @endforeach -->
            </tbody>
        </table>
    </div>
</div>
@endsection
