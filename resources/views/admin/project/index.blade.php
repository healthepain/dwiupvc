@extends('layouts.app')

@section('content')
    <div class="card shadow mb-4">

        <div class="card-header py-3 d-flex justify-content-between align-items-center">

            <div class="mb-1 mr-2">
                <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahProject">
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
                            <th>Nama Project</th>
                            <th>Detail Client</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th>Nilai Project</th>
                            <th>
                                <i class="fas fa-cogs"></i>
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($projects as $index => $project)
                            <tr>

                                <td width="50">
                                    {{ $index + 1 }}
                                </td>

                                <td>
                                    {{ $project->project_name }}
                                </td>
                                <td>
                                    {{ $project->nama_client }} - {{ $project->alamat_project }}
                                </td>
                                <td>
                                    {{ $project->project_description }}
                                </td>

                                <td>
                                    {{ $project->project_status }}
                                </td>

                                <td>
                                    Rp {{ number_format($project->value_project, 0, ',', '.') }}
                                </td>

                                <td>

                                    <a href="{{ route('project.show', $project->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <button type="button" class="btn btn-sm btn-danger btn-delete-project"
                                        data-id="{{ $project->id }}" data-nama="{{ $project->project_name }}"
                                        data-status="{{ $project->project_status }}"
                                        data-nilai="{{ $project->value_project }}" data-toggle="modal"
                                        data-target="#hapusProject">

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

    <!-- Modal Tambah Project -->
    <div class="modal fade" id="tambahProject" tabindex="-1" role="dialog" aria-labelledby="tambahProjectLabel"
        aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">

                <!-- Modal Header -->
                <div class="modal-header border-0 pt-4 px-4 pb-2">
                    <div>
                        <h5 class="modal-title font-weight-bold text-dark" id="tambahProjectLabel">
                            Tambah Project Baru
                        </h5>

                        <p class="text-muted small mb-0">
                            Tambahkan project baru ke dalam sistem.
                        </p>
                    </div>

                    <button class="close bg-light rounded-circle p-2 d-flex align-items-center justify-content-center"
                        style="width: 32px; height: 32px; transition: 0.2s;" type="button" data-dismiss="modal"
                        aria-label="Close">

                        <span aria-hidden="true" style="line-height: 0;">
                            &times;
                        </span>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body px-4 pb-4">

                    <form method="POST" action="{{ route('project.store') }}">
                        @csrf

                        <!-- Nama Project -->
                        <div class="form-group mb-3">
                            <label class="small font-weight-bold text-secondary mb-1">
                                Nama Project
                            </label>

                            <input type="text" name="project_name" class="form-control bg-light border-0 py-2"
                                style="border-radius: 8px;" placeholder="Masukkan nama project"
                                value="{{ old('project_name') }}" required autocomplete="off">
                        </div>


                        <div class="form-group mb-3">
                            <label class="small font-weight-bold text-secondary mb-1">
                                Nama Client
                            </label>

                            <input type="text" name="nama_client" class="form-control bg-light border-0 py-2"
                                style="border-radius: 8px;" placeholder="Masukkan nama client"
                                value="{{ old('nama_client') }}" required autocomplete="off">
                        </div>
                        <div class="form-group mb-3">
                            <label class="small font-weight-bold text-secondary mb-1">
                                Alamat Project
                            </label>

                            <input type="text" name="alamat_project" class="form-control bg-light border-0 py-2"
                                style="border-radius: 8px;" placeholder="Masukkan alamat project"
                                value="{{ old('alamat_client') }}" required autocomplete="off">
                        </div>
                        <!-- Deskripsi Project -->
                        <div class="form-group mb-3">
                            <label class="small font-weight-bold text-secondary mb-1">
                                Deskripsi Project
                            </label>

                            <textarea name="project_description" class="form-control bg-light border-0" style="border-radius: 8px;" rows="3"
                                placeholder="Masukkan deskripsi project" required>{{ old('project_description') }}</textarea>
                        </div>
                        <!-- Status & Nilai Project -->
                        <div class="row">

                            <!-- Status -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">

                                    <label class="small font-weight-bold text-secondary mb-1">
                                        Status Project
                                    </label>

                                    <select name="project_status" class="form-control bg-light border-0 custom-select"
                                        style="border-radius: 8px; height: auto; padding-top: 8px; padding-bottom: 8px;"
                                        required>

                                        <option value="not_started"
                                            {{ old('project_status') == 'not_started' ? 'selected' : '' }}>
                                            Belum Dimulai
                                        </option>

                                        <option value="in_progress"
                                            {{ old('project_status') == 'in_progress' ? 'selected' : '' }}>
                                            Sedang Berjalan
                                        </option>

                                        <option value="completed"
                                            {{ old('project_status') == 'completed' ? 'selected' : '' }}>
                                            Selesai
                                        </option>

                                    </select>

                                </div>
                            </div>

                            <!-- Nilai Project -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">

                                    <label class="small font-weight-bold text-secondary mb-1">
                                        Nilai Project
                                    </label>

                                    <input type="number" name="value_project"
                                        class="form-control bg-light border-0 py-2" style="border-radius: 8px;"
                                        placeholder="Contoh: 25000000" value="{{ old('value_project') }}" min="0"
                                        required>

                                </div>
                            </div>

                        </div>

                        <!-- Keterangan Nilai -->
                        <small class="form-text text-muted mb-4" style="font-size: 11px;">
                            Masukkan nilai project dalam Rupiah tanpa titik atau koma.
                            Contoh: 25000000.
                        </small>

                        <!-- Modal Footer -->
                        <div class="d-flex justify-content-end gap-2 border-0 pt-2">

                            <button class="btn btn-light font-weight-bold px-4 py-2 mr-2 text-secondary"
                                style="border-radius: 8px;" type="button" data-dismiss="modal">
                                Batal
                            </button>

                            <button class="btn btn-primary font-weight-bold px-4 py-2 shadow-sm"
                                style="border-radius: 8px; background-color: #0d6efd;" type="submit">
                                Simpan Project
                            </button>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal Hapus Project -->
    <div class="modal fade" id="hapusProject" tabindex="-1" role="dialog" aria-labelledby="deleteProjectModalLabel"
        aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg">

                <!-- Modal Body -->
                <div class="modal-body p-4 text-center">

                    <!-- Icon Peringatan -->
                    <div class="mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-light-danger rounded-circle"
                            style="width: 80px; height: 80px; background-color: #fff5f5;">

                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#dc3545"
                                class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">

                                <path
                                    d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />

                            </svg>

                        </div>
                    </div>

                    <!-- Judul -->
                    <h4 class="font-weight-bold text-dark mb-2" id="deleteProjectModalLabel">
                        Hapus Project?
                    </h4>

                    <p class="text-muted small px-3 mb-4">
                        Tindakan ini tidak dapat dibatalkan.
                        Project yang dihapus akan dihapus secara permanen dari sistem.
                    </p>

                    <!-- Detail Project -->
                    <div class="text-left bg-light p-3 rounded-lg mb-4 border border-light-secondary"
                        style="background-color: #f8f9fa; border-radius: 12px;">

                        <!-- Nama Project -->
                        <div class="row mb-2">
                            <div class="col-4 text-muted font-weight-bold small">
                                Nama Project
                            </div>

                            <div class="col-8 text-dark font-weight-600" id="nama-project">
                                -
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="row mb-2">
                            <div class="col-4 text-muted font-weight-bold small">
                                Status
                            </div>

                            <div class="col-8">
                                <span class="badge badge-secondary px-2 py-1" id="status-project">
                                    -
                                </span>
                            </div>
                        </div>

                        <!-- Nilai Project -->
                        <div class="row">
                            <div class="col-4 text-muted font-weight-bold small">
                                Nilai Project
                            </div>

                            <div class="col-8 text-dark font-weight-600" id="nilai-project">
                                -
                            </div>
                        </div>

                    </div>

                    <!-- Form Delete -->
                    <form id="form-delete-project" method="POST">

                        @csrf
                        @method('DELETE')

                        <div class="d-flex justify-content-center gap-2">

                            <button class="btn btn-light font-weight-bold px-4 py-2 mr-2 text-secondary"
                                style="border-radius: 8px;" type="button" data-dismiss="modal">
                                Batal
                            </button>

                            <button class="btn btn-danger font-weight-bold px-4 py-2 shadow-sm"
                                style="border-radius: 8px; background-color: #dc3545;" type="submit">
                                Ya, Hapus Project
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
        $(document).on('click', '.btn-delete-project', function() {

            let id = $(this).data('id');
            let nama = $(this).data('nama');
            let status = $(this).data('status');
            let nilai = $(this).data('nilai');

            // Tampilkan data project
            $('#nama-project').text(nama);

            // Status
            let statusText = {
                'not_started': 'Belum Dimulai',
                'in_progress': 'Sedang Berjalan',
                'completed': 'Selesai'
            };

            $('#status-project').text(statusText[status] || status);

            // Format nilai rupiah
            $('#nilai-project').text(
                'Rp ' + new Intl.NumberFormat('id-ID').format(nilai)
            );

            // Set action form
            $('#form-delete-project').attr(
                'action',
                '/project/' + id
            );
        });
    </script>
@endpush
