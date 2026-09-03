@extends('layouts.app')

@section('content')


<h1 class="h3 mb-4 text-gray-800">
    {{ $title }}
</h1>

<div class="card shadow mb-4">

    <div class="card-header py-3 d-flex justify-content-between align-items-center">

        <div class="mb-1 mr-2">
            <a href="#" class="btn btn-sm btn-primary">
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
                                {{ $project->project_description }}
                            </td>

                            <td>
                                {{ $project->project_status }}
                            </td>

                            <td>
                                Rp {{ number_format($project->value_project, 0, ',', '.') }}
                            </td>

                            <td>

                                <a href="#" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <button
                                    class="btn btn-sm btn-danger btn-delete"
                                    data-id="{{ $project->id }}"
                                    data-nama="{{ $project->project_name }}"
                                    data-toggle="modal"
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


@endsection
