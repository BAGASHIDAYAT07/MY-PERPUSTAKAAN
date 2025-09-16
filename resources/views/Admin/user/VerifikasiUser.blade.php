@extends('template.app')

@section("konten")
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-body text-center">
            <h4 class="mb-3">Verifikasi Email Anda</h4>
            <p>Sebelum melanjutkan, silakan cek email Anda untuk link verifikasi.</p>
            <p>Jika belum menerima email, klik tombol di bawah untuk mengirim ulang.</p>

            @if (session('message'))
                <div class="alert alert-success mt-3">
                    {{ session('message') }}
                </div>
            @endif

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn btn-primary mt-3">
                    Kirim Ulang Email Verifikasi
                </button>
            </form>
        </div>
    </div>
</div>
@endsection


