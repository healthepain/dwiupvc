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
                <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahProduct">
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
                                <td> {{-- Edit --}} <a href="{{ route('project.show', $projects->id) }}"
                                        class="btn btn-sm btn-primary"> <i class="fas fa-edit"></i> </a>
                                    {{-- Hapus --}} <button type="button"
                                        class="btn btn-sm btn-danger btn-delete-product"
                                        data-id="{{ $product->pivot->id }}" data-nama="{{ $product->product_name }}"
                                        data-lebar="{{ $product->pivot->lebar_kusen }}"
                                        data-tinggi="{{ $product->pivot->tinggi_kusen }}"
                                        data-harga-hitam="{{ $product->pivot->harga_hitam }}"
                                        data-harga-putih="{{ $product->pivot->harga_putih }}"
                                        data-action="{{ route('product-project.destroy', [
                                            'productProject' => $product->pivot->id,
                                        ]) }}"
                                        data-toggle="modal" data-target="#hapusProduct"> <i class="fas fa-trash"></i>
                                    </button> </td>
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




    <!-- Modal Tambah Product -->

    <div class="modal fade" id="tambahProduct" tabindex="-1" role="dialog" aria-labelledby="tambahProductLabel"
        aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">

                <!-- Modal Header -->
                <div class="modal-header border-0 pt-4 px-4 pb-2">
                    <div>
                        <h5 class="modal-title font-weight-bold text-dark" id="tambahProductLabel">
                            Tambah Product
                        </h5>

                        <p class="text-muted small mb-0">
                            Tambahkan product ke dalam project.
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

                    <form id="formTambahProduct" method="POST"
                        action="{{ route('product-project.store', $projects->id) }}">

                        @csrf

                        <!-- Product -->
                        <div class="form-group mb-3">

                            <label class="small font-weight-bold text-secondary mb-1">
                                Product
                            </label>

                            <select id="product_id" name="product_id" class="form-control bg-light border-0 custom-select"
                                style="border-radius: 8px; height: auto; padding-top: 8px; padding-bottom: 8px;" required>

                                <option value="">
                                    -- Pilih Product --
                                </option>

                            </select>

                        </div>

                        <!-- Ukuran Kusen -->
                        <div class="row">

                            <!-- Lebar -->
                            <div class="col-md-6">

                                <div class="form-group mb-3">

                                    <label class="small font-weight-bold text-secondary mb-1">
                                        Lebar Kusen
                                    </label>

                                    <div class="input-group">

                                        <input type="number" id="lebar_kusen" name="lebar_kusen"
                                            class="form-control bg-light border-0 py-2" style="border-radius: 8px;"
                                            placeholder="Contoh: 1.20" step="0.01" min="0" disabled required>

                                        <div class="input-group-append">
                                            <span class="input-group-text bg-light border-0">
                                                m
                                            </span>
                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!-- Tinggi -->
                            <div class="col-md-6">

                                <div class="form-group mb-3">

                                    <label class="small font-weight-bold text-secondary mb-1">
                                        Tinggi Kusen
                                    </label>

                                    <div class="input-group">

                                        <input type="number" id="tinggi_kusen" name="tinggi_kusen"
                                            class="form-control bg-light border-0 py-2" style="border-radius: 8px;"
                                            placeholder="Contoh: 2.00" step="0.01" min="0" disabled required>

                                        <div class="input-group-append">
                                            <span class="input-group-text bg-light border-0">
                                                m
                                            </span>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- Harga -->
                        <div class="row">

                            <!-- Harga Hitam -->
                            <div class="col-md-6">

                                <div class="form-group mb-3">

                                    <label class="small font-weight-bold text-secondary mb-1">
                                        Harga Hitam
                                    </label>

                                    <div id="harga_hitam_display"
                                        class="form-control bg-light border-0 font-weight-bold text-dark"
                                        style="border-radius: 8px;">
                                        Rp 0
                                    </div>

                                </div>

                            </div>

                            <!-- Harga Putih -->
                            <div class="col-md-6">

                                <div class="form-group mb-3">

                                    <label class="small font-weight-bold text-secondary mb-1">
                                        Harga Putih
                                    </label>

                                    <div id="harga_putih_display"
                                        class="form-control bg-light border-0 font-weight-bold text-dark"
                                        style="border-radius: 8px;">
                                        Rp 0
                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- Keterangan -->
                        <small class="form-text text-muted mb-4" style="font-size: 11px;">
                            Harga akan dihitung otomatis berdasarkan product dan ukuran
                            kusen yang dipilih.
                        </small>

                        <!-- Modal Footer -->
                        <div class="d-flex justify-content-end gap-2 border-0 pt-2">

                            <button class="btn btn-light font-weight-bold px-4 py-2 mr-2 text-secondary"
                                style="border-radius: 8px;" type="button" data-dismiss="modal">

                                Batal

                            </button>

                            <button id="btnTambahProduct" class="btn btn-primary font-weight-bold px-4 py-2 shadow-sm"
                                style="border-radius: 8px; background-color: #0d6efd;" type="submit" disabled>

                                Tambah Product

                            </button>

                        </div>

                    </form>

                </div>

            </div>
        </div>

    </div>

    <!-- Modal Hapus Product -->
    <div class="modal fade" id="hapusProduct" tabindex="-1" role="dialog" aria-labelledby="deleteProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg"> <!-- Modal Body -->
                <div class="modal-body p-4 text-center"> <!-- Icon Peringatan -->
                    <div class="mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle"
                            style="width: 80px; height: 80px; background-color: #fff5f5;"> <svg
                                xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#dc3545"
                                viewBox="0 0 16 16">
                                <path
                                    d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                            </svg> </div>
                    </div> <!-- Judul -->
                    <h4 class="font-weight-bold text-dark mb-2" id="deleteProductModalLabel"> Hapus Product dari Project?
                    </h4>
                    <p class="text-muted small px-3 mb-4"> Product ini akan dihapus dari project. Data product utama tetap
                        tersimpan di sistem. </p> <!-- Detail Product -->
                    <div class="text-left bg-light p-3 rounded-lg mb-4 border border-light-secondary"
                        style="background-color: #f8f9fa; border-radius: 12px;"> <!-- Nama Product -->
                        <div class="row mb-2">
                            <div class="col-4 text-muted font-weight-bold small"> Product </div>
                            <div class="col-8 text-dark font-weight-600" id="nama-product"> - </div>
                        </div> <!-- Ukuran -->
                        <div class="row mb-2">
                            <div class="col-4 text-muted font-weight-bold small"> Ukuran </div>
                            <div class="col-8 text-dark font-weight-600" id="ukuran-product"> - </div>
                        </div> <!-- Harga -->
                        <div class="row">
                            <div class="col-4 text-muted font-weight-bold small"> Harga </div>
                            <div class="col-8 text-dark font-weight-600" id="harga-product"> - </div>
                        </div>
                    </div> <!-- Form Delete -->
                    <form id="form-delete-product" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="button" class="btn btn-light" data-dismiss="modal">
                            Batal
                        </button>

                        <button type="submit" class="btn btn-danger">
                            Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).on('click', '.btn-delete-product', function() {

            const action = $(this).data('action');
            const nama = $(this).data('nama');
            const lebar = $(this).data('lebar');
            const tinggi = $(this).data('tinggi');
            const hargaHitam = $(this).data('harga-hitam');
            const hargaPutih = $(this).data('harga-putih');

            $('#nama-product').text(nama);

            $('#ukuran-product').text(
                lebar + ' × ' + tinggi
            );

            $('#harga-product').html(
                'Hitam: Rp ' +
                new Intl.NumberFormat('id-ID').format(hargaHitam || 0) +
                '<br>' +
                'Putih: Rp ' +
                new Intl.NumberFormat('id-ID').format(hargaPutih || 0)
            );

            $('#form-delete-product').attr('action', action);
        });
    </script>
@endpush



@push('scripts')
    <script>
        function toNumber(value) {
            if (value === null || value === undefined || value === '') {
                return 0;
            }

            const number = Number(value);

            return Number.isFinite(number) ? number : 0;
        }

        document.addEventListener('DOMContentLoaded', function() {

            // =========================
            // Element
            // =========================

            const productSelect = document.getElementById('product_id');
            const lebarInput = document.getElementById('lebar_kusen');
            const tinggiInput = document.getElementById('tinggi_kusen');

            const hargaHitamDisplay =
                document.getElementById('harga_hitam_display');

            const hargaPutihDisplay =
                document.getElementById('harga_putih_display');

            const btnTambahProduct =
                document.getElementById('btnTambahProduct');


            // =========================
            // Simpan data product
            // =========================

            let products = [];


            // =========================
            // Ambil product dari Laravel
            // =========================

            async function loadProducts() {

                try {

                    const response = await fetch(
                        '{{ route('product-project.products') }}'
                    );

                    if (!response.ok) {
                        throw new Error('Gagal mengambil data product');
                    }

                    // PENTING:
                    // Jangan gunakan "const products" di sini
                    // karena akan membuat variable baru.
                    products = await response.json();


                    // Kosongkan select
                    productSelect.innerHTML = `
                <option value="">
                    -- Pilih Product --
                </option>
            `;


                    // Masukkan product ke select
                    products.forEach(product => {

                        const option = document.createElement('option');

                        option.value = product.id;
                        option.textContent = product.product_name;

                        productSelect.appendChild(option);

                    });


                } catch (error) {

                    console.error(error);

                }
            }


            // =========================
            // Reset form
            // =========================

            function resetForm() {

                lebarInput.value = '';
                tinggiInput.value = '';

                lebarInput.disabled = true;
                tinggiInput.disabled = true;

                hargaHitamDisplay.textContent = 'Rp 0';
                hargaPutihDisplay.textContent = 'Rp 0';

                btnTambahProduct.disabled = true;
            }


            // =========================
            // Product dipilih
            // =========================

            productSelect.addEventListener('change', function() {

                const productId = this.value;


                // Jika tidak ada product
                if (!productId) {

                    resetForm();

                    return;
                }


                // Cari product
                const product = products.find(
                    item => item.id == productId
                );


                if (!product) {

                    resetForm();

                    return;
                }


                // =========================
                // Aktifkan input ukuran
                // =========================

                lebarInput.disabled = false;
                tinggiInput.disabled = false;


                // =========================
                // Ambil ukuran default
                // dari tabel products
                // =========================

                lebarInput.value =
                    parseFloat(product.lebar_kusen) || 0;

                tinggiInput.value =
                    parseFloat(product.tinggi_kusen) || 0;


                // =========================
                // Hitung harga awal
                // =========================

                hitungHarga();


                // Aktifkan tombol
                btnTambahProduct.disabled = false;

            });


            // =========================
            // Hitung harga
            // =========================

            function hitungHarga() {
                const productId = productSelect.value;

                const lebar = toNumber(lebarInput.value);
                const tinggi = toNumber(tinggiInput.value);

                const product = products.find(
                    item => item.id == productId
                );

                if (!product) {
                    hargaHitamDisplay.textContent = 'Rp 0';
                    hargaPutihDisplay.textContent = 'Rp 0';
                    return;
                }

                // =========================
                // Lebar & tinggi daun
                // =========================
                const lebarDaun = lebar;
                const tinggiDaun = tinggi;

                // =========================
                // Panjang kusen
                // =========================
                const pKusen =
                    (lebar * toNumber(product.jumlah_lebar_kusen)) +
                    (tinggi * toNumber(product.jumlah_tinggi_kusen));

                // =========================
                // Panjang daun
                // =========================
                const pDaun =
                    (lebarDaun * toNumber(product.jumlah_lebar_daun)) +
                    (tinggiDaun * toNumber(product.jumlah_tinggi_daun));

                // =========================
                // Luas kaca / panel
                // =========================
                const luas = lebar * tinggi;

                // =========================
                // Harga kusen
                // =========================
                const kusen =
                    pKusen * toNumber(product.harga_kusen);

                // =========================
                // Harga daun
                // =========================
                const daun =
                    pDaun * toNumber(product.harga_daun);

                // =========================
                // Harga kaca + panel
                // =========================
                const kacaPanel =
                    (
                        toNumber(product.harga_kaca) +
                        toNumber(product.harga_panel)
                    ) * luas;

                // =========================
                // Harga hitam
                // =========================
                const hargaHitam =
                    kusen +
                    daun +
                    kacaPanel +
                    toNumber(product.harga_aksesoris);

                // =========================
                // Harga putih
                // =========================
                const hargaPutih =
                    hargaHitam * 0.85;

                // =========================
                // Tampilkan harga
                // =========================
                hargaHitamDisplay.textContent =
                    'Rp ' + formatRupiah(Math.round(hargaHitam));

                hargaPutihDisplay.textContent =
                    'Rp ' + formatRupiah(Math.round(hargaPutih));
            }


            // =========================
            // Format Rupiah
            // =========================

            function formatRupiah(number) {

                return new Intl.NumberFormat('id-ID').format(number);

            }


            // =========================
            // Ukuran berubah
            // =========================

            lebarInput.addEventListener('input', function() {

                hitungHarga();

            });


            tinggiInput.addEventListener('input', function() {

                hitungHarga();

            });


            // =========================
            // Modal dibuka
            // =========================

            $('#tambahProduct').on('shown.bs.modal', function() {

                loadProducts();

            });


            // =========================
            // Modal ditutup
            // =========================

            $('#tambahProduct').on('hidden.bs.modal', function() {

                productSelect.value = '';

                resetForm();

            });

        });
    </script>
@endpush
