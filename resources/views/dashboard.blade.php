@extends('layouts.app')

@section('content')

    <div class="row">
        <!-- Tombol Lihat Barang -->
        <div class="col-6 col-xl-3 col-md-6 mb-4">
            <a href="#" class="text-decoration-none h-100 d-block">
                <div class="card border-left-primary shadow h-100 py-3 transition-hover">
                    <div class="card-body py-1">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-xs font-weight-bold text-primary text-uppercase tracking-wide">
                                    Lihat Barang
                                </div>
                            </div>
                            <div class="text-primary opacity-75 small">
                                <i class="fas fa-boxes fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Tombol Buat Penjualan (Highlight Gradient) -->
        <div class="col-6 col-xl-3 col-md-6 mb-4">
            <a href="#" class="text-decoration-none h-100 d-block">
                <div class="card shadow h-100 py-3 border-left-primary border-0 transition-hover">
                    <div class="card-body py-1">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-xs font-weight-bold text-primary text-uppercase tracking-wide">
                                    Buat Penjualan
                                </div>
                            </div>
                            <div class="text-primary opacity-75 small">
                                <i class="fas fa-plus-circle fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Tombol Lihat Penjualan -->
        <div class="col-6 col-xl-3 col-md-6 mb-4">
            <a href="#" class="text-decoration-none h-100 d-block">
                <div class="card border-left-primary shadow h-100 py-3 transition-hover">
                    <div class="card-body py-1">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-xs font-weight-bold text-primary text-uppercase tracking-wide">
                                    Lihat Penjualan
                                </div>
                            </div>
                            <div class="text-primary opacity-75 small">
                                <i class="fas fa-shopping-cart fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Tombol Lihat Modal -->
        <div class="col-6 col-xl-3 col-md-6 mb-4">
            <a href="#" class="text-decoration-none h-100 d-block">
                <div class="card bg-gray-400 shadow h-100 py-3 transition-hover">
                    <div class="card-body py-1">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-xs font-weight-bold text-primary text-uppercase tracking-wide">
                                    Lihat Modal
                                </div>
                            </div>
                            <div class="text-primary opacity-75 small">
                                <i class="fas fa-wallet fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>


@endsection
