<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Smoke Zone</title>

    <!-- Fonts -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        /* Reset & base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
            background: #0b0b0a;
            color: #f5f5f4;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }

        /* Card sederhana */
        .card {
            width: 100%;
            max-width: 420px;
            padding: 2.5rem 2rem;
            background: #141412;
            border-radius: 1.5rem;
            border: 1px solid #22221f;
            text-align: center;
            box-shadow: 0 20px 60px -20px rgba(0, 0, 0, 0.8);
        }

        /* Judul */
        .title {
            font-size: 2.5rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            line-height: 1.1;
            margin-bottom: 0.5rem;
        }

        .title span {
            color: #f97316;
        }

        /* Deskripsi */
        .description {
            font-size: 1rem;
            line-height: 1.6;
            color: #a8a8a4;
            margin-bottom: 2rem;
            max-width: 320px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Tombol */
        .actions {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.65rem 1.8rem;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 600;
            font-family: inherit;
            text-decoration: none;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
            min-width: 120px;
        }

        .btn-primary {
            background: #ea580c;
            color: #fff;
            box-shadow: 0 4px 16px -4px rgba(234, 88, 12, 0.3);
        }

        .btn-primary:hover {
            background: #f97316;
            transform: translateY(-2px);
            box-shadow: 0 8px 24px -6px rgba(234, 88, 12, 0.4);
        }

        .btn-secondary {
            background: transparent;
            color: #d4d4d0;
            border: 1px solid #2a2a27;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.04);
            border-color: #4a4a47;
            color: #fff;
        }

        /* Responsif */
        @media (max-width: 480px) {
            .card {
                padding: 2rem 1.5rem;
            }
            .title {
                font-size: 2rem;
            }
            .btn {
                padding: 0.6rem 1.2rem;
                font-size: 0.85rem;
                min-width: 100px;
            }
        }

        @media (max-width: 380px) {
            .actions {
                flex-direction: column;
                width: 100%;
            }
            .btn {
                width: 100%;
                min-width: unset;
            }
        }

        /* Selection */
        ::selection {
            background: rgba(234, 88, 12, 0.3);
            color: #fff;
        }
    </style>
</head>
<body>

    <main class="card">

        <!-- Judul -->
        <h1 class="title">
            Lucius <span>Artorius</span>
        </h1>

        <!-- Deskripsi -->
        <p class="description">
            Platform manajemen data dan monitoring terintegrasi.
        </p>

        <!-- Tombol -->
        <div class="actions">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">
                        Masuk
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-secondary">
                            Daftar
                        </a>
                    @endif
                @endauth
            @endif
        </div>

    </main>

</body>
</html>