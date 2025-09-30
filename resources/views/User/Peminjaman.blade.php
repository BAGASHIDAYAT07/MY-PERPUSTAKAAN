@extends('template.app')

@section("konten")
<div class="container">
    <h1>Daftar Peminjaman</h1>
    <a href="{{ route('peminjaman.create') }}" class="btn btn-primary mb-3">Tambah Peminjaman</a>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User</th>
                <th>Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peminjamans as $peminjaman)
            <tr>
                <td>{{ $peminjaman->user->name }}</td>
                <td>{{ $peminjaman->buku->judul }}</td>
                <td>{{ $peminjaman->tanggal_pinjam }}</td>
                <td>{{ $peminjaman->tanggal_kembali ?? '-' }}</td>
                <td>{{ ucfirst($peminjaman->status) }}</td>
                <td>
                    <a href="{{ route('peminjaman.edit', $peminjaman) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('peminjaman.destroy', $peminjaman) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin ingin hapus?')" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $peminjamans->links() }}
</div>

@endsection
