@extends('template.app')

@section("konten")
<div class="d-flex">

  <!-- Main Content -->
  <div class="flex-fill p-4">
    <div class="container-fluid">
      <h3 class="mb-4">Manajemen User</h3>

      <div class="card shadow-sm">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
              <input type="checkbox" id="selectAll"> <label for="selectAll" class="ms-1">Pilih semua</label>
            </div>
            <button class="btn btn-outline-primary btn-sm">Export selected users</button>
          </div>

          <div class="mb-3">
            <input type="search" class="form-control form-control-sm" placeholder="Cari user...">
          </div>

          <table class="table table-hover align-middle">
            <thead class="table-dark">
              <tr>
                <th scope="col"></th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">NIS</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <!-- User 1 -->
              <tr>
                <td><input type="checkbox"></td>
                <td>
                  <img src="https://ui-avatars.com/api/?name=Enggal+Dwi" class="rounded-circle me-2" width="32" height="32">
                  Enggal Dwi
                </td>
                <td>enggal@example.com</td>
                <td>USR001</td>
                <td>Laki-laki</td>
                <td>
                  <button class="btn btn-sm btn-success toggle-status">Aktif</button>
                </td>
                <td>
                  <div class="dropdown">
                    <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#">Create</a></li>
                      <li><a class="dropdown-item" href="#">Update</a></li>
                      <li><a class="dropdown-item text-danger" href="#">Nonaktifkan</a></li>
                    </ul>
                  </div>
                </td>
              </tr>

              <!-- User 2 -->
              <tr>
                <td><input type="checkbox"></td>
                <td>
                  <img src="https://ui-avatars.com/api/?name=Antooks" class="rounded-circle me-2" width="32" height="32">
                  antooks
                </td>
                <td>antoks@example.com</td>
                <td>USR002</td>
                <td>Laki-laki</td>
                <td>
                  <button class="btn btn-sm btn-danger toggle-status">Nonaktif</button>
                </td>
                <td>
                  <div class="dropdown">
                    <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#">Create</a></li>
                      <li><a class="dropdown-item" href="#">Update</a></li>
                      <li><a class="dropdown-item text-success" href="#">Aktifkan</a></li>
                    </ul>
                  </div>
                </td>
              </tr>

              <!-- User 3 -->
              <tr>
                <td><input type="checkbox"></td>
                <td>
                  <img src="https://ui-avatars.com/api/?name=Bagasss" class="rounded-circle me-2" width="32" height="32">
                  bagasss
                </td>
                <td>bagas@example.com</td>
                <td>USR003</td>
                <td>Laki-laki</td>
                <td>
                  <button class="btn btn-sm btn-success toggle-status">Aktif</button>
                </td>
                <td>
                  <div class="dropdown">
                    <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#">Create</a></li>
                      <li><a class="dropdown-item" href="#">Update</a></li>
                      <li><a class="dropdown-item text-danger" href="#">Nonaktifkan</a></li>
                    </ul>
                  </div>
                </td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- JS untuk Select All dan Toggle -->
<script>
  // Select All Checkbox
  document.getElementById('selectAll').addEventListener('click', function () {
    const checkboxes = document.querySelectorAll('tbody input[type="checkbox"]');
    checkboxes.forEach(cb => cb.checked = this.checked);
  });

  // Toggle Aktif/Nonaktif Button
  document.querySelectorAll('.toggle-status').forEach(btn => {
    btn.addEventListener('click', function () {
      if (this.classList.contains('btn-success')) {
        this.classList.remove('btn-success');
        this.classList.add('btn-danger');
        this.textContent = 'Nonaktif';
      } else {
        this.classList.remove('btn-danger');
        this.classList.add('btn-success');
        this.textContent = 'Aktif';
      }
    });
  });
</script>
@endsection
