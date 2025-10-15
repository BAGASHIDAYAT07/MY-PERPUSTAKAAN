@extends('template.app')

@section("konten")
<div class="container-fluid px-3 pb-3" style="margin-top: -25px;">
    <!-- Judul Halaman -->
    <!-- <div class="d-flex align-items-center justify-content-between bg-white shadow-sm p-3 rounded mb-4">
        <div class="d-flex align-items-center">
            <i class="bi bi-speedometer2 fs-2 text-primary me-3"></i>
            <div>
                <h1 class="fs-3 fw-bold mb-0">Dashboard</h1>
                <small class="fs-6 text-muted fw-normal">Ringkasan aktivitas & statistik</small>
            </div>
        </div>
    </div> -->
    <div class="d-flex align-items-center justify-content-between p-4 rounded"
         style="background: linear-gradient(90deg, #2e7d32 0%, #4caf50 50%, #e8f5e9 100%);
                color: white;
                border-radius: 15px;
                box-shadow: 0 4px 10px rgba(0,0,0,0.1);">

      <!-- Teks Kiri -->
      <div>
        <h4 class="fw-bold mb-2">Halo Admin! Kelola perpustakaan dengan mudah di sini 📚</h4>
        <p class="mb-0" style="color: #e8f5e9;">
          Halaman ini adalah pusat kontrol untuk mengelola data perpustakaan<br>
          mulai dari koleksi buku, data anggota, hingga laporan peminjaman.
        </p>
      </div>

      <!-- Gambar Kanan -->
      <!-- <img src="{{ asset('img/tumbuk/tumpukanBuku.png') }}"
           alt="Books"
           class="img-fluid"
           style="width: 130px; height: auto;"> -->
           <img src="{{ asset('img/tumbuk/tumpukanBuku.png') }}"
       alt="Books"
       class="img-fluid position-absolute"
       style="width: 130px;
              height: auto;
              right:  20px;   /* keluar sedikit dari garis kanan */
              bottom: 445px;"> <!-- bisa disesuaikan -->
    </div>

    <!-- Selector Tahun -->
    <div class="my-4">
        <select id="TahunSelector" 
            class="form-select fw-semibold shadow-sm w-100 fs-6 py-2 px-3 rounded">
            <option value="2025" selected>2025</option>
            <option value="2026">2026</option>
            <option value="2027">2027</option>
            <option value="2028">2028</option>
            <option value="2029">2029</option>
            <option value="2030">2030</option>
        </select>
    </div>

    <!-- Statistik Kartu -->
    <div class="row g-3">
        <!-- Jumlah Buku -->
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100 bg-white">
                <div class="card-body text-center">
                    <i class="bi bi-book fs-2 text-primary"></i>
                    <p class="fs-6 text-muted fw-normal mb-1 mt-2">Jumlah Buku</p>
                    <h4 class="fs-4 fw-semibold mb-0">{{ $jumlahBuku }}</h4>
                </div>
            </div>
        </div>

        <!-- Jumlah User -->
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100 bg-white">
                <div class="card-body text-center">
                    <i class="bi bi-people fs-2 text-success"></i>
                    <p class="fs-6 text-muted fw-normal mb-1 mt-2">Jumlah User</p>
                    <h4 class="fs-4 fw-semibold mb-0">{{ $jumlahUser }}</h4>
                </div>
            </div>
        </div>

        <!-- Peminjaman -->
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100 bg-white">
                <div class="card-body text-center">
                    <i class="bi bi-box-arrow-up fs-2 text-warning"></i>
                    <p class="fs-6 text-muted fw-normal mb-1 mt-2">Peminjaman</p>
                    <h4 class="fs-4 fw-semibold mb-0" id="jumlahPeminjaman">{{ $jumlahPeminjaman }}</h4>
                </div>
            </div>
        </div>

        <!-- Pengembalian -->
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100 bg-white">
                <div class="card-body text-center">
                    <i class="bi bi-box-arrow-down fs-2 text-info"></i>
                    <p class="fs-6 text-muted fw-normal mb-1 mt-2">Pengembalian</p>
                    <h4 class="fs-4 fw-semibold mb-0" id="jumlahPengembalian">{{ $jumlahPengembalian }}</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Statistik -->
    <div class="card shadow-sm border-0 my-4">
        <div class="card-header bg-white border-bottom fw-bold fs-6">
            <i class="bi bi-graph-up-arrow me-1"></i> Statistik Peminjaman
        </div>
        <div class="card-body">
            <canvas id="visitorChart" width="100%" height="30"></canvas>
        </div>
    </div>

    <!-- Tabel Data Harian -->

    <div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Data Harian</h5>

        <div>
            <select id="filter-bulan" class="form-select d-inline w-auto">
                @foreach ([
                    1=>'Januari', 2=>'Februari', 3=>'Maret', 4=>'April',
                    5=>'Mei', 6=>'Juni', 7=>'Juli', 8=>'Agustus',
                    9=>'September', 10=>'Oktober', 11=>'November', 12=>'Desember'
                ] as $key => $nama)
                    <option value="{{ $key }}" {{ $key == date('n') ? 'selected' : '' }}>
                        {{ $nama }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Peminjaman</th>
                    <th>Pengembalian</th>
                </tr>
            </thead>
            <tbody id="tabel-harian">
                @foreach ($dataHarian as $row)
                    <tr>
                        <td>{{ $row['tanggal'] }}</td>
                        <td><span class="badge bg-success">{{ $row['total_peminjaman'] }}</span></td>
                        <td><span class="badge bg-primary">{{ $row['total_pengembalian'] }}</span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<!-- Bootstrap Toast Notification -->
<div class="position-fixed top-0 start-50 translate-middle-x p-3" style="z-index: 9999; margin-top: 20px;">
  @if (session('success'))
    <div class="toast align-items-center text-bg-success border-0 show shadow" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body">
          <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  @endif

  @if (session('error'))
    <div class="toast align-items-center text-bg-danger border-0 show shadow" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body">
          <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  @endif
</div>

<!-- Script Grafik -->
<script>
const ctx = document.getElementById('visitorChart').getContext('2d');

let visitorChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
        datasets: [
            {
                label: 'Peminjaman',
                data: {!! $peminjamanPerBulan !!},
                backgroundColor: 'rgba(40, 167, 69, 0.7)',
                borderColor: 'rgba(40, 167, 69, 1)',
                borderWidth: 1,
                borderRadius: 5,
            },
            {
                label: 'Pengembalian',
                data: {!! $pengembalianPerBulan !!},
                backgroundColor: 'rgba(0, 123, 255, 0.7)',
                borderColor: 'rgba(0, 123, 255, 1)',
                borderWidth: 1,
                borderRadius: 5,
            }
        ]
    },
    options: {
        plugins: { legend: { display: true } },
        scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
    }
});

// ======== 📊 Update Data Saat Ganti Tahun ========
document.getElementById("TahunSelector").addEventListener("change", function() {
    let tahun = this.value;
    let bulan = document.getElementById("filter-bulan").value; // ambil bulan aktif juga

    fetch(`/dashboard/data/${tahun}/${bulan}`)
        .then(response => response.json())
        .then(data => {
            // Update angka kartu
            document.querySelector("#jumlahPeminjaman").textContent = data.jumlahPeminjaman;
            document.querySelector("#jumlahPengembalian").textContent = data.jumlahPengembalian;

            // Update grafik
            visitorChart.data.datasets[0].data = data.peminjamanPerBulan;
            visitorChart.data.datasets[1].data = data.pengembalianPerBulan;
            visitorChart.update();

            // ✅ Update tabel harian
            const tbody = document.getElementById('tabel-harian');
            tbody.innerHTML = '';

            if (data.dataHarian.length > 0) {
                data.dataHarian.forEach(row => {
                    tbody.innerHTML += `
                        <tr>
                            <td>${row.tanggal}</td>
                            <td><span class="badge bg-success">${row.total_peminjaman}</span></td>
                            <td><span class="badge bg-primary">${row.total_pengembalian}</span></td>
                        </tr>`;
                });
            } else {
                tbody.innerHTML = `<tr><td colspan="3" class="text-center text-muted">Tidak ada data</td></tr>`;
            }
        })
        .catch(error => console.error("Error fetch data:", error));
});


// ======== 📅 Update Data Saat Ganti Bulan ========
document.getElementById('filter-bulan').addEventListener('change', function() {
    const bulan = this.value;
    const tahun = document.getElementById("TahunSelector").value; // ambil tahun aktif juga

    fetch(`/dashboard/data/${tahun}/${bulan}`)
        .then(res => res.json())
        .then(data => {
            const tbody = document.getElementById('tabel-harian');
            tbody.innerHTML = '';

            if (data.dataHarian.length === 0) {
                tbody.innerHTML = `<tr><td colspan="3" class="text-center">Tidak ada data</td></tr>`;
            } else {
                data.dataHarian.forEach(row => {
                    tbody.innerHTML += `
                        <tr>
                            <td>${row.tanggal}</td>
                            <td><span class="badge bg-success">${row.total_peminjaman}</span></td>
                            <td><span class="badge bg-primary">${row.total_pengembalian}</span></td>
                        </tr>`;
                });
            }
        })
        .catch(err => console.error(err));
});


// ======== 🔔 Tampilkan Toast Otomatis ========
document.addEventListener('DOMContentLoaded', function () {
    const toastElList = [].slice.call(document.querySelectorAll('.toast'));
    toastElList.map(function (toastEl) {
        const toast = new bootstrap.Toast(toastEl, { delay: 4000 });
        toast.show();
    });
});


</script>

@endsection
