@extends('layouts.app')

@section('content')
    <div class="row">
        <!-- Tombol Lihat Barang -->
        <div class="col-12 col-xl-3 col-md-6 mb-4">
            <a href="{{ route('project.index') }}" class="text-decoration-none h-100 d-block">
                <div class="card border-left-primary shadow h-100 py-3 transition-hover">
                    <div class="card-body py-1">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-xs font-weight-bold text-primary text-uppercase tracking-wide">
                                    Lihat Project
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

    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Project / Bulan</h6>
        </div>
        <div class="card-body">
            <div class="chart-bar">
                <canvas id="myBarChart"></canvas>
            </div>
            <hr>
            Ini adalah chart jumlah project perbulan
            
        </div>
    </div>
@endsection
