@extends('template.app')

@section("konten")
<div class="container-fluid px-3 pb-3" style="margin-top: -25px;">
    <!-- Judul Halaman -->
<div class="d-flex align-items-center justify-content-between bg-white shadow-sm p-3 rounded mb-4">
    <div class="d-flex align-items-center">
        <i class="bi bi-speedometer2 fs-3 text-primary me-3"></i>
        <div>
            <h1 class="fw-bold mb-0">Dashboard</h1>
            <small class="text-muted">Ringkasan aktivitas & statistik</small>
        </div>
    </div>
</div>

    <!-- Separator Bulan -->
    <div class="my-4">
    <select id="TahunSelector" 
        class="form-select fw-bold border-b-blue-400 shadow-sm w-100" 
        style="font-size: 1rem; padding: 0.75rem 1rem; border-radius: 8px;">
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
                    <p class="text-muted small mb-1 mt-2">Jumlah Buku</p>
                    <h4 class="fw-bold mb-0">320</h4>
                </div>
            </div>
        </div>

        <!-- Jumlah User -->
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100 bg-white">
                <div class="card-body text-center">
                    <i class="bi bi-people fs-2 text-success"></i>
                    <p class="text-muted small mb-1 mt-2">Jumlah User</p>
                    <h4 class="fw-bold mb-0">120</h4>
                </div>
            </div>
        </div>

        <!-- Peminjaman -->
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100 bg-white">
                <div class="card-body text-center">
                    <i class="bi bi-box-arrow-up fs-2 text-warning"></i>
                    <p class="text-muted small mb-1 mt-2">Peminjaman</p>
                    <h4 class="fw-bold mb-0">58</h4>
                </div>
            </div>
        </div>

        <!-- Pengembalian -->
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100 bg-white">
                <div class="card-body text-center">
                    <i class="bi bi-box-arrow-down fs-2 text-info"></i>
                    <p class="text-muted small mb-1 mt-2">Pengembalian</p>
                    <h4 class="fw-bold mb-0">45</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Statistik -->
    <div class="card shadow-sm border-0 my-4">
        <div class="card-header bg-white border-bottom fw-bold">
            <i class="bi bi-graph-up-arrow me-1"></i> Statistik Peminjaman
        </div>
        <div class="card-body">
            <canvas id="visitorChart" width="100%" height="30"></canvas>
        </div>
    </div>

    <!-- Tabel Data Harian -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-bottom fw-bold">
            <i class="bi bi-calendar-check me-1"></i> Data Harian
        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0 align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Peminjaman</th>
                        <th>Pengembalian</th>
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

<!-- Script Grafik -->
<script>
  document.getElementById("TahunSelector").addEventListener("change", function() {
        let TahunDipilih = this.value;
        console.log("Tahun yang dipilih:", TahunDipilih);

        // TODO: ganti data tabel / grafik sesuai bulanDipilih
        // misalnya panggil AJAX / fetch data ke server Laravel
    });

    const ctx = document.getElementById('visitorChart').getContext('2d');
    const visitorChart = new Chart(ctx, {
        type: 'bar', // Diagram batang/tabung
        data: {
            labels: [
                "Jan", "Feb", "Mar", "Apr", "Mei", "Jun",
                "Jul", "Agu", "Sep", "Okt", "Nov", "Des"
            ],
            datasets: [
                {
                    label: 'Peminjaman',
                    data: [120, 150, 180, 200, 170, 140, 160, 190, 210, 180, 150, 130], 
                    backgroundColor: 'rgba(40, 167, 69, 0.7)',  // hijau transparan
                    borderColor: 'rgba(40, 167, 69, 1)',        // hijau solid
                    borderWidth: 1,
                    borderRadius: 5, // batang agak melengkung
                },
                {
                    label: 'Pengembalian',
                    data: [100, 130, 160, 180, 150, 120, 140, 170, 190, 160, 140, 120], 
                    backgroundColor: 'rgba(0, 123, 255, 0.7)',   // biru transparan
                    borderColor: 'rgba(0, 123, 255, 1)',         // biru solid
                    borderWidth: 1,
                    borderRadius: 5,
                }
            ]
        },
        options: {
            plugins: {
                legend: { display: true } // biar ada keterangan warnanya
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 }
                }
            }
        }
    });
</script>
@endsection
