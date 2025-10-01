@extends('template.appu')

@section("kontenU")

<div class="container mt-4">
    <h2 class="mb-4"><i class="bi bi-book"></i>History Peminjaman</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Judul Buku</th>
                        <th>Peminjam</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($histories as $index => $history)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $history->buku->judul }}</td>
                            <td>{{ $history->user->name }}</td>
                            <td>{{ $history->tgl_pinjam }}</td>
                            <td>{{ $history->tgl_kembali ?? '-' }}</td>
                            <td>
                                @if($history->status == 'dikembalikan')
                                    <span class="badge bg-success">Dikembalikan</span>
                                @else
                                    <span class="badge bg-warning">Dipinjam</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada history peminjaman</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection