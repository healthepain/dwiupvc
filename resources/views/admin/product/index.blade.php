@extends('layouts.app')

@section('content')


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
                        <th>Nama Product</th>
                        <th>Lebar Kusen</th>
                        <th>Tinggi Kusen</th>
                        <th>Lebar Daun</th>
                        <th>Tinggi Daun</th>
                        <th>Harga Kusen</th>
                        <th>Harga Daun</th>
                        <th>Harga Kaca</th>
                        <th>Harga Panel</th>
                        <th>Harga Aksesoris</th>
                        <th>
                            <i class="fas fa-cogs"></i>
                        </th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($products as $index => $product)

                        <tr>

                            <td width="50">
                                {{ $index + 1 }}
                            </td>

                            <td>
                                {{ $product->product_name }}
                            </td>

                            <td>
                                {{ $product->lebar_kusen }}
                            </td>

                            <td>
                                {{ $product->tinggi_kusen }}
                            </td>

                            <td>
                                {{ $product->lebar_daun }}
                            </td>

                            <td>
                                {{ $product->tinggi_daun }}
                            </td>

                            <td>
                                Rp {{ number_format($product->harga_kusen, 0, ',', '.') }}
                            </td>

                            <td>
                                Rp {{ number_format($product->harga_daun, 0, ',', '.') }}
                            </td>

                            <td>
                                Rp {{ number_format($product->harga_kaca, 0, ',', '.') }}
                            </td>

                            <td>
                                Rp {{ number_format($product->harga_panel, 0, ',', '.') }}
                            </td>

                            <td>
                                Rp {{ number_format($product->harga_aksesoris, 0, ',', '.') }}
                            </td>

                            <td>

                                <a href="#" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <button
                                    class="btn btn-sm btn-danger btn-delete"
                                    data-id="{{ $product->id }}"
                                    data-nama="{{ $product->product_name }}"
                                    data-toggle="modal"
                                    data-target="#hapusProduct">
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
