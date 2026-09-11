@extends('layouts.app')

@section('content')

    <div class="card shadow mb-4">

        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <div class="mb-1 mr-2">
                <a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahUser">
                    <i class="fas fa-plus"></i>
                    Tambah Data
                </a>
            </div>
            <div class="mb-1">
                <a href="#" class="btn btn-sm btn-success">
                    <i class="fas fa-file-excel"></i>
                    Excel
                </a>
                <a href="#" class="btn btn-sm btn-danger">
                    <i class="fas fa-file-pdf"></i>
                    PDF
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Jabatan</th>
                            <th>
                                <i class="fas fa-cogs"></i>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $index => $user)
                            <tr>
                                <td width="50">{{ $index + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="text-center">
                                    <span class="badge badge-primary badge-pill ">{{ $user->role }}</span>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $user->id }}"
                                        data-nama="{{ $user->name }}" data-email="{{ $user->email }}"
                                        data-role="{{ $user->role }}" data-toggle="modal" data-target="#hapusUser">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tambahUser" tabindex="-1" role="dialog" aria-labelledby="tambahUserLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">

                <!-- Modal Header -->
                <div class="modal-header border-0 pt-4 px-4 pb-2">
                    <div>
                        <h5 class="modal-title font-weight-bold text-dark" id="tambahUserLabel">Tambah Pengguna Baru</h5>
                        <p class="text-muted small mb-0">Dafrarkan akun pengguna baru ke dalam sistem.</p>
                    </div>
                    <button class="close bg-light rounded-circle p-2 d-flex align-items-center justify-content-center"
                        style="width: 32px; height: 32px; transition: 0.2s;" type="button" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true" style="line-height: 0;">&times;</span>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body px-4 pb-4">
                    <form method="POST" action="{{ route('user.store') }}">
                        @csrf

                        <!-- Grid Row untuk Nama & Role supaya hemat tempat -->
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group mb-3">
                                    <label class="small font-weight-bold text-secondary mb-1">Nama Lengkap</label>
                                    <div class="input-group">
                                        <input type="text" name="name" class="form-control bg-light border-0 py-2"
                                            style="border-radius: 8px;" placeholder="Masukkan nama lengkap" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group mb-3">
                                    <label class="small font-weight-bold text-secondary mb-1">Hak Akses / Role</label>
                                    <select name="role" class="form-control bg-light border-0 custom-select"
                                        style="border-radius: 8px; height: auto; padding-top: 8px; padding-bottom: 8px;"
                                        required>
                                        <option value="admin">Admin</option>
                                        <option value="pengguna">Pengguna</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Email Field -->
                        <div class="form-group mb-3">
                            <label class="small font-weight-bold text-secondary mb-1">Alamat Email</label>
                            <input type="email" name="email" class="form-control bg-light border-0 py-2"
                                style="border-radius: 8px;" placeholder="contoh@domain.com" required>
                        </div>

                        <!-- Password Field -->
                        <div class="form-group mb-4">
                            <label class="small font-weight-bold text-secondary mb-1">Kata Sandi</label>
                            <input type="password" name="password" class="form-control bg-light border-0 py-2"
                                style="border-radius: 8px;" placeholder="Minimal 8 karakter" required>
                            <small class="form-text text-muted style-italic" style="font-size: 11px;">
                                Pastikan menggunakan kombinasi huruf dan angka yang aman.
                            </small>
                        </div>

                        <!-- Modal Footer (Didalam form agar tombol submit berfungsi murni) -->
                        <div class="d-flex justify-content-end gap-2 border-0 pt-2">
                            <button class="btn btn-light font-weight-bold px-4 py-2 mr-2 text-secondary"
                                style="border-radius: 8px;" type="button" data-dismiss="modal">
                                Batal
                            </button>
                            <button class="btn btn-primary font-weight-bold px-4 py-2 shadow-sm"
                                style="border-radius: 8px; background-color: #0d6efd;" type="submit">
                                Simpan Pengguna
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="hapusUser" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg">

                <!-- Modal Body (Kita satukan agar layout lebih mengalir) -->
                <div class="modal-body p-4 text-center">

                    <!-- Icon Peringatan Besar -->
                    <div class="mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-light-danger rounded-circle"
                            style="width: 80px; height: 80px; background-color: #fff5f5;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#dc3545"
                                class="bi bi-exclamation-triangle-fill animate-bounce" viewBox="0 0 16 16">
                                <path
                                    d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                            </svg>
                        </div>
                    </div>

                    <h4 class="font-weight-bold text-dark mb-2" id="deleteModalLabel">Hapus Pengguna?</h4>
                    <p class="text-muted small px-3 mb-4">Tindakan ini tidak dapat dibatalkan. Seluruh data akses pengguna
                        ini akan dihapus secara permanen dari sistem.</p>

                    <!-- Detail Data User (Gaya Card Minimalis) -->
                    <div class="text-left bg-light p-3 rounded-lg mb-4 border border-light-secondary"
                        style="background-color: #f8f9fa; border-radius: 12px;">
                        <div class="row mb-2">
                            <div class="col-4 text-muted font-weight-bold small">Nama</div>
                            <div class="col-8 text-dark font-weight-600" id="nama-user">-</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 text-muted font-weight-bold small">Email</div>
                            <div class="col-8 text-dark text-break" id="email-user">-</div>
                        </div>
                        <div class="row">
                            <div class="col-4 text-muted font-weight-bold small">Jabatan</div>
                            <div class="col-8"><span class="badge badge-secondary px-2 py-1" id="role-user">-</span>
                            </div>
                        </div>
                    </div>

                    <!-- Form & Tombol Aksi -->
                    <form id="form-delete" method="POST">
                        @csrf
                        @method('DELETE')

                        <div class="d-flex justify-content-center gap-2">
                            <button class="btn btn-light font-weight-bold px-4 py-2 mr-2 text-secondary"
                                style="border-radius: 8px;" type="button" data-dismiss="modal">
                                Batal
                            </button>
                            <button class="btn btn-danger font-weight-bold px-4 py-2 shadow-sm"
                                style="border-radius: 8px; background-color: #dc3545;" type="submit">
                                Ya, Hapus User
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function() {

                let id = this.dataset.id;
                let nama = this.dataset.nama;
                let email = this.dataset.email;
                let role = this.dataset.role;

                document.getElementById('form-delete').action = '/user/' + id;
                document.getElementById('nama-user').innerText = nama;
                document.getElementById('email-user').innerText = email;
                document.getElementById('role-user').innerText = role;
            });
        });
    </script>
@endpush
