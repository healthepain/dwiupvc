@extends('layouts.app')

@section('content')
    {{-- <h1 class="h3 mb-4 text-gray-800">
        {{ $title }}
    </h1> --}}


    <div class="card border-0 shadow-sm rounded-4 mb-4">
        {{-- Header --}}
        <div
            class="card-header bg-white border-0 pt-4 px-4 pb-3 d-flex justify-content-between align-items-start flex-wrap gap-2">
            <div>
                <small class="text-uppercase text-muted fw-bold" style="font-size: .7rem; letter-spacing: .05em;">
                    Ringkasan Informasi
                </small>
                <h5 class="mb-0 fw-bold text-dark mt-1">{{ $projects->project_name }}</h5>
            </div>

            {{-- Badge Status --}}
            @php
                $statusMap = [
                    'active' => ['bg-success-subtle text-success border-success-subtle', 'Active'],
                    'pending' => ['bg-warning-subtle text-warning border-warning-subtle', 'Pending'],
                    'completed' => ['bg-primary-subtle text-primary border-primary-subtle', 'Completed'],
                ];
                $status = $statusMap[$projects->project_status] ?? [
                    'bg-secondary-subtle text-secondary border-secondary-subtle',
                    ucfirst($projects->project_status),
                ];
            @endphp

            <span class="badge {{ $status[0] }} border rounded-pill px-3 py-2 fw-semibold">
                <i class="fas fa-circle fa-xs me-1"></i> {{ $status[1] }}
            </span>
        </div>

        {{-- Body --}}
        <div class="card-body px-4 pb-4 pt-0">
            <div class="row g-3">
                {{-- Nilai Proyek --}}
                <div class="col-md-4">
                    <div class="p-3 bg-light rounded-3 h-100">
                        <small class="text-muted d-block mb-1">Nilai Proyek</small>
                        <h4 class="fw-bold text-primary mb-0">
                            Rp {{ number_format($projects->value_project, 0, ',', '.') }}
                        </h4>
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="col-md-8">
                    <div class="p-3 bg-light rounded-3 h-100">
                        <small class="text-muted d-block mb-1">Deskripsi Proyek</small>
                        <p class="mb-0 text-dark small" style="line-height: 1.6;">
                            {{ $projects->project_description ?? 'Tidak ada deskripsi.' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>




    {{-- PRODUCT DALAM PROJECT --}}
    <div class="card shadow mb-4">

        <div class="card-header py-3 d-flex justify-content-between align-items-center">

            <div class="mb-1 mr-2">
                <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahProject">
                    <i class="fas fa-plus"></i>
                    Tambah Product
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
                            <th>Product</th>
                            <th>Tinggi Kusen</th>
                            <th>Lebar Kusen</th>
                            <th>Harga Hitam</th>
                            <th>Harga Putih</th>
                            <th>
                                <i class="fas fa-cogs"></i>
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($projects->products as $product)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    {{ $product->product_name }}
                                </td>

                                <td>
                                    {{ $product->pivot->tinggi_kusen }}
                                </td>

                                <td>
                                    {{ $product->pivot->lebar_kusen }}
                                </td>

                                <td>
                                    Rp {{ number_format($product->pivot->harga_hitam, 0, ',', '.') }}
                                </td>

                                <td>
                                    Rp {{ number_format($product->pivot->harga_putih, 0, ',', '.') }}
                                </td>
                                <td>

                                    <a href="{{ route('project.show', $projects->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <button type="button" class="btn btn-sm btn-danger btn-delete-project"
                                        data-id="{{ $projects->id }}" data-nama="{{ $projects->project_name }}"
                                        data-status="{{ $projects->project_status }}"
                                        data-nilai="{{ $projects->value_project }}" data-toggle="modal"
                                        data-target="#hapusProject">

                                        <i class="fas fa-trash"></i>

                                    </button>

                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="text-center">
                                    Belum ada product dalam project ini.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>


                </table>

            </div>

        </div>

    </div>




    <!-- Modal Tambah Project -->
@endsection
