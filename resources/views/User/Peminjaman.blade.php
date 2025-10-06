@extends('template.appu')

@section("kontenU")
<div class="container">
    <h1>Daftar Peminjaman</h1>

    <!-- <a href="{{ route('peminjaman.create') }}" class="btn btn-primary mb-3">Tambah Peminjaman</a> -->

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>User</th>
                <th>Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peminjamans as $peminjaman)
                <tr>
                    <td>{{ $peminjaman->user->email ?? '-' }}</td>
                    <td>{{ $peminjaman->buku->judul ?? '-' }}</td>
                    <td>{{ $peminjaman->buku->jenis_buku ?? '-' }}</td>

                    {{-- Format tanggal menjadi DD-MM-YYYY --}}
                    <td>{{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d-m-Y') }}</td>

                    <td>
                        {{-- Tombol titik tiga dropdown --}}
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="aksiDropdown{{ $peminjaman->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                ⋮
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="aksiDropdown{{ $peminjaman->id }}">
                                <li>
                                    <a class="dropdown-item" href="{{ route('peminjaman.edit', $peminjaman->id) }}">
                                        Edit
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('peminjaman.destroy', $peminjaman->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="dropdown-item text-danger" type="submit">
                                            Hapus
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection