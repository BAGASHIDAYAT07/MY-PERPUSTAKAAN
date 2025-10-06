@extends('template.app')

@section("konten")
<div class="container-fluid px-3 pb-3" style="margin-top: -25px;">
    <!-- Judul Halaman -->
    <div class="d-flex align-items-center justify-content-between bg-white shadow-sm p-3 rounded mb-4">
        <div class="d-flex align-items-center">
            <i class="bi bi-speedometer2 fs-2 text-primary me-3"></i>
            <div>
                <h1 class="fs-3 fw-bold mb-0">Dashboard</h1>
                <small class="fs-6 text-muted fw-normal">Ringkasan aktivitas & statistik</small>
            </div>
        </div>
    </div>

    <!-- Selector Tahun -->
    <div class="my-4">
        <select id="TahunSelector" 
            class="form-select fw-semibold shadow-sm w-100 fs-6 py-2 px-3 rounded">
            <option value="2025" selected>2025</option>
            <option value="2026">2026</option>
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
                    <h4 class="fs-4 fw-semibold mb-0">58</h4>
                </div>
            </div>
        </div>

        <!-- Pengembalian -->
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100 bg-white">
                <div class="card-body text-center">
                    <i class="bi bi-box-arrow-down fs-2 text-info"></i>
                    <p class="fs-6 text-muted fw-normal mb-1 mt-2">Pengembalian</p>
                    <h4 class="fs-4 fw-semibold mb-0">45</h4>
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
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-bottom fw-bold fs-6">
            <i class="bi bi-calendar-check me-1"></i> Data Harian
        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0 align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th class="fw-semibold">Tanggal</th>
                        <th class="fw-semibold">Peminjaman</th>
                        <th class="fw-semibold">Pengembalian</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2025-09-01</td>
                        <td><span class="badge bg-success">3</span></td>
                        <td><span class="badge bg-info">2</span></td>
                    </tr>
                    <tr>
                        <td>2025-09-02</td>
                        <td><span class="badge bg-success">5</span></td>
                        <td><span class="badge bg-info">3</span></td>
                    </tr>
                    <tr>
                        <td>2025-09-03</td>
                        <td><span class="badge bg-success">4</span></td>
                        <td><span class="badge bg-info">4</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
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
  document.getElementById("TahunSelector").addEventListener("change", function() {
        let TahunDipilih = this.value;
        console.log("Tahun yang dipilih:", TahunDipilih);
        // TODO: fetch data sesuai tahun
    });

    const ctx = document.getElementById('visitorChart').getContext('2d');
    const visitorChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                "Jan", "Feb", "Mar", "Apr", "Mei", "Jun",
                "Jul", "Agu", "Sep", "Okt", "Nov", "Des"
            ],
            datasets: [
                {
                    label: 'Peminjaman',
                    data: [120, 150, 180, 200, 170, 140, 160, 190, 210, 180, 150, 130], 
                    backgroundColor: 'rgba(40, 167, 69, 0.7)',
                    borderColor: 'rgba(40, 167, 69, 1)',
                    borderWidth: 1,
                    borderRadius: 5,
                },
                {
                    label: 'Pengembalian',
                    data: [100, 130, 160, 180, 150, 120, 140, 170, 190, 160, 140, 120], 
                    backgroundColor: 'rgba(0, 123, 255, 0.7)',
                    borderColor: 'rgba(0, 123, 255, 1)',
                    borderWidth: 1,
                    borderRadius: 5,
                }
            ]
        },
        options: {
            plugins: {
                legend: { display: true }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 }
                }
            }
        }
    });

    // Tampilkan toast otomatis
  document.addEventListener('DOMContentLoaded', function () {
    const toastElList = [].slice.call(document.querySelectorAll('.toast'));
    toastElList.map(function (toastEl) {
      const toast = new bootstrap.Toast(toastEl, { delay: 4000 });
      toast.show();
    });
  });
</script>
@endsection
