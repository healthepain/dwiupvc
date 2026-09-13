<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Project - {{ $project->project_name }}</title>
    <style>
        @page {
            size: A4;
            margin: 15mm 15mm 20mm 15mm;

            @bottom-center {
                content: "Dicetak pada {{ now()->format('d-m-Y H:i') }}";
                font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                font-size: 8pt;
                color: #888888;
            }
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 9.5pt;
            line-height: 1.5;
            color: #2d3748;
            margin: 0;
            padding: 0;
        }

        /* Header Section */
        .header {
            border-bottom: 2px solid #1a202c;
            padding-bottom: 12px;
            margin-bottom: 24px;
        }

        .header-title {
            font-size: 20pt;
            font-weight: 700;
            color: #1a202c;
            margin: 0 0 4px 0;
            letter-spacing: -0.5px;
        }

        .header-subtitle {
            font-size: 9pt;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #718096;
            margin: 0;
            font-weight: 600;
        }

        /* Section Title */
        .section-title {
            font-size: 11pt;
            font-weight: 700;
            color: #2d3748;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
            padding-bottom: 4px;
            border-bottom: 1px solid #e2e8f0;
        }

        /* Project Info Table */
        .project-info {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 24px;
        }

        .project-info td {
            padding: 6px 0;
            vertical-align: top;
        }

        .project-info .label {
            width: 140px;
            font-weight: 600;
            color: #4a5568;
        }

        .project-info .separator {
            width: 15px;
            color: #718096;
        }

        .project-info .value {
            color: #1a202c;
        }

        .status-badge {
            font-weight: 600;
            color: #2b6cb0;
        }

        /* Summary Cards */
        .summary-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 12px 0;
            margin-left: -12px;
            margin-right: -12px;
            margin-bottom: 16px;
        }

        .summary-card {
            width: 50%;
            background-color: #f7fafc;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            padding: 10px 14px;
        }

        .summary-label {
            font-size: 8.5pt;
            color: #718096;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .summary-value {
            font-size: 13pt;
            font-weight: 700;
            color: #1a202c;
        }

        /* Products Table */
        table.products {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }

        table.products th {
            background-color: #edf2f7;
            color: #2d3748;
            font-weight: 700;
            font-size: 8.5pt;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: 1px solid #cbd5e0;
            padding: 8px 10px;
        }

        table.products td {
            border: 1px solid #e2e8f0;
            padding: 8px 10px;
            font-size: 9pt;
        }

        table.products tbody tr:nth-child(even) {
            background-color: #f7fafc;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .empty-row {
            padding: 16px !important;
            color: #718096;
            font-style: italic;
        }
    </style>
</head>

<body>

    {{-- HEADER --}}
    <div class="header">
        <h1 class="header-title">{{ $project->project_name }}</h1>
        <p class="header-subtitle">Detail Project</p>
    </div>

    {{-- INFORMASI PROJECT --}}
    <div class="section-title">Informasi Project</div>
    <table class="project-info">
        <tr>
            <td class="label">Nama Project</td>
            <td class="separator">:</td>
            <td class="value"><strong>{{ $project->project_name }}</strong></td>
        </tr>
        <tr>
            <td class="label">Status</td>
            <td class="separator">:</td>
            <td class="value status-badge">{{ ucfirst($project->project_status) }}</td>
        </tr>
        <tr>
            <td class="label">Tanggal Dibuat</td>
            <td class="separator">:</td>
            <td class="value">{{ $project->created_at ? $project->created_at->format('d-m-Y') : '-' }}</td>
        </tr>
        <tr>
            <td class="label">Deskripsi</td>
            <td class="separator">:</td>
            <td class="value">{{ $project->project_description ?: 'Tidak ada deskripsi.' }}</td>
        </tr>
    </table>

    {{-- PRODUCT --}}
    <div class="section-title">Product</div>

    <table class="summary-table">
        <tr>
            <td class="summary-card">
                <div class="summary-label">Total Harga Hitam</div>
                <div class="summary-value">Rp
                    {{ number_format($project->products->sum(fn($product) => $product->pivot->harga_hitam)) }}</div>
            </td>
            <td class="summary-card">
                <div class="summary-label">Total Harga Putih</div>
                <div class="summary-value">Rp
                    {{ number_format($project->products->sum(fn($product) => $product->pivot->harga_putih)) }}</div>
            </td>
        </tr>
    </table>

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
                    <td colspan="6" class="center empty-row">
                        Belum ada product dalam project ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>
