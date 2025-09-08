@extends('template.app')

@section("konten")

<h1 class="mt-4">Peminjaman Buku</h1>

<div class="card mb-4">
  <div class="card-header">
    <i class="fas fa-table me-1"></i>
    <a href="/create" class="btn btn-primary">Tambah Peminjaman</a>
  </div>
  <div class="card-body">
    <table id="datatablesSimple" class="table table-bordered">
      <thead>
        <tr>
          <th>Name</th>
          <th>Position</th>
          <th>Office</th>
          <th>Age</th>
          <th>Start date</th>
          <th>Salary</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{ $peminjaman->name }}</td>
          <td>{{ $peminjaman->position }}</td>
          <td>{{ $peminjaman->office }}</td>
          <td>{{ $peminjaman->age }}</td>
          <td>{{ $peminjaman->start_date }}</td>
          <td>{{ $peminjaman->salary }}</td>
          <td>
            <a href="{{ url('/peminjaman/'.$peminjaman->id.'/edit') }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ url('/peminjaman/'.$peminjaman->id) }}" method="POST" style="display:inline-block;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">Delete</button>
            </form>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

@endsection
