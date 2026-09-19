<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Project - {{ $project->project_name }}</title>
    <style>
        @page {
            size: A4;
            margin: 18mm 18mm 22mm 18mm;

            @bottom-center {
                content: "Dicetak pada {{ now()->format('d-m-Y H:i') }}";
                font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                font-size: 8pt;
                color: #94a3b8;
            }
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 10pt;
            line-height: 1.6;
            color: #1e293b;
            margin: 0;
            padding: 0;
        }

        /* ==================== HEADER ==================== */
        .header {
            width: 100%;
            border-collapse: collapse;
            border-bottom: 2px solid #0f172a;
            margin-bottom: 26px;
        }

        .header td {
            vertical-align: middle;
            padding-bottom: 14px;
        }

        .header-left {
            text-align: left;
        }

        .header-right {
            text-align: right;
            width: 130px;
        }

        .header-title {
            font-size: 18pt;
            font-weight: 700;
            color: #0f172a;
            margin: 0 0 3px 0;
            letter-spacing: -0.3px;
            line-height: 1.2;
        }

        .header-subtitle {
            font-size: 8.5pt;
            text-transform: uppercase;
            letter-spacing: 1.4px;
            color: #64748b;
            margin: 0;
            font-weight: 600;
        }

        .logo {
            max-height: 60px;
            max-width: 130px;
            object-fit: contain;
        }

        /* ==================== SECTION ==================== */
        .section {
            margin-bottom: 26px;
        }

        .section-title {
            font-size: 10.5pt;
            font-weight: 700;
            color: #0f172a;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 0 0 12px 0;
            padding-bottom: 6px;
            border-bottom: 1px solid #0f172a;
        }

        /* ==================== INFO LIST (label : value) ==================== */
        .info-list {
            width: 100%;
            border-collapse: collapse;
        }

        .info-list td {
            padding: 4px 0;
            vertical-align: top;
            font-size: 10pt;
        }

        .info-list .label {
            width: 140px;
            color: #64748b;
            font-weight: 400;
        }

        .info-list .separator {
            width: 12px;
            color: #94a3b8;
        }

        .info-list .value {
            color: #0f172a;
            font-weight: 500;
        }

        /* ==================== TOTAL SECTION ==================== */
        .total-list {
            width: 100%;
            border-collapse: collapse;
        }

        .total-list td {
            padding: 5px 0;
            font-size: 10.5pt;
        }

        .total-list .label {
            color: #64748b;
            width: 200px;
        }

        .total-list .separator {
            width: 12px;
            color: #94a3b8;
        }

        .total-list .value {
            color: #0f172a;
            font-weight: 700;
        }

        /* ==================== PRODUCTS TABLE ==================== */
        table.products {
            width: 100%;
            border-collapse: collapse;
            margin-top: 4px;
        }

        table.products th {
            background-color: transparent;
            color: #0f172a;
            font-weight: 700;
            font-size: 9pt;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            padding: 10px 8px;
            text-align: left;
            border-bottom: 1.5px solid #0f172a;
            border-top: 1.5px solid #0f172a;
        }

        table.products td {
            padding: 9px 8px;
            font-size: 9.5pt;
            color: #1e293b;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: top;
        }

        table.products tbody tr:last-child td {
            border-bottom: 1.5px solid #0f172a;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .empty-row {
            padding: 20px !important;
            color: #94a3b8;
            font-style: italic;
            text-align: center;
        }
    </style>
</head>

<body>

    {{-- ==================== HEADER ==================== --}}
    <table class="header">
        <tr>
            <td class="header-left">
                <h1 class="header-title">{{ $project->project_name }}</h1>
                <p class="header-subtitle">Detail Project</p>
            </td>
            <td class="header-right">
                <img src="{{ public_path('images/dwi.png') }}" alt="Logo" class="logo">
            </td>
        </tr>
    </table>

    {{-- ==================== INFORMASI PROJECT ==================== --}}
    <div class="section">
        <div class="section-title">Informasi Project</div>

        <table class="info-list">
            <tr>
                <td class="label">Nama Client</td>
                <td class="separator">:</td>
                <td class="value">{{ $project->nama_client ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Alamat Project</td>
                <td class="separator">:</td>
                <td class="value">{{ $project->alamat_project ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Status</td>
                <td class="separator">:</td>
                <td class="value">{{ ucfirst($project->project_status) }}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Dibuat</td>
                <td class="separator">:</td>
                <td class="value">
                    {{ $project->created_at ? $project->created_at->format('d-m-Y') : '-' }}
                </td>
            </tr>
            <tr>
                <td class="label">Deskripsi</td>
                <td class="separator">:</td>
                <td class="value">{{ $project->project_description ?: 'Tidak ada deskripsi.' }}</td>
            </tr>
        </table>
    </div>

    {{-- ==================== PRODUCT ==================== --}}
    <div class="section">
        <div class="section-title">Product</div>

        {{-- Total --}}
        <table class="total-list">
            <tr>
                <td class="label">Total Harga Hitam</td>
                <td class="separator">:</td>
                <td class="value">
                    Rp {{ number_format($project->products->sum(fn($p) => $p->pivot->harga_hitam), 0, ',', '.') }}
                </td>
            </tr>
            <tr>
                <td class="label">Total Harga Putih</td>
                <td class="separator">:</td>
                <td class="value">
                    Rp {{ number_format($project->products->sum(fn($p) => $p->pivot->harga_putih), 0, ',', '.') }}
                </td>
            </tr>
        </table>

        <div style="height: 16px;"></div>

        {{-- Tabel Product --}}
        <table class="products">
            <thead>
                <tr>
                    <th width="5%" class="center">No</th>
                    <th width="27%">Product</th>
                    <th width="14%" class="center">Tinggi Kusen</th>
                    <th width="14%" class="center">Lebar Kusen</th>
                    <th width="20%" class="right">Harga Hitam</th>
                    <th width="20%" class="right">Harga Putih</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($project->products as $product)
                    <tr>
                        <td class="center">{{ $loop->iteration }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td class="center">{{ $product->pivot->tinggi_kusen }}</td>
                        <td class="center">{{ $product->pivot->lebar_kusen }}</td>
                        <td class="right">Rp {{ number_format($product->pivot->harga_hitam ?? 0, 0, ',', '.') }}</td>
                        <td class="right">Rp {{ number_format($product->pivot->harga_putih ?? 0, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty-row">
                            Belum ada product dalam project ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>

</html>
