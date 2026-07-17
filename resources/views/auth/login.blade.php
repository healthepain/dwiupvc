<!-- File: resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Smoke Zone — Login</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />

    <style>
        /* Reset & Base */
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
            position: relative;
        }

        /* Glow background (sama seperti landing) */
        .bg-glow {
            position: fixed;
            inset: 0;
            z-index: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .bg-glow::before {
            content: '';
            position: absolute;
            top: -30%;
            left: -20%;
            width: 80%;
            height: 80%;
            background: radial-gradient(ellipse at 30% 20%, rgba(234, 88, 12, 0.12), transparent 70%);
            animation: floatGlow 12s ease-in-out infinite alternate;
        }

        .bg-glow::after {
            content: '';
            position: absolute;
            bottom: -30%;
            right: -20%;
            width: 70%;
            height: 70%;
            background: radial-gradient(ellipse at 70% 80%, rgba(234, 88, 12, 0.06), transparent 70%);
            animation: floatGlow 14s ease-in-out infinite alternate-reverse;
        }

        @keyframes floatGlow {
            0% {
                transform: translate(0, 0) scale(1);
            }
            100% {
                transform: translate(4%, 3%) scale(1.1);
            }
        }

        /* Card */
        .login-card {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 420px;
            background: rgba(20, 20, 18, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 1.75rem;
            border: 1px solid rgba(255, 255, 255, 0.04);
            box-shadow: 0 30px 80px -20px rgba(0, 0, 0, 0.8), inset 0 1px 0 rgba(255, 255, 255, 0.03);
            padding: 2.25rem 2rem 2.5rem;
            transition: box-shadow 0.3s ease;
        }

        .login-card:hover {
            box-shadow: 0 40px 100px -20px rgba(234, 88, 12, 0.08), 0 30px 80px -20px rgba(0, 0, 0, 0.8);
        }

        /* Header */
        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header h1 {
            font-size: 2.25rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            line-height: 1.1;
        }

        .login-header h1 span {
            color: #f97316;
        }

        .login-header p {
            color: #a8a8a4;
            font-size: 0.95rem;
            margin-top: 0.4rem;
        }

        /* Session status */
        .session-status {
            background: rgba(16, 185, 129, 0.08);
            border-left: 3px solid #10b981;
            color: #6ee7b7;
            padding: 0.6rem 1rem;
            border-radius: 12px;
            font-size: 0.85rem;
            margin-bottom: 1.5rem;
        }

        /* Form group */
        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            font-size: 0.85rem;
            font-weight: 500;
            color: #c8c8c4;
            margin-bottom: 0.4rem;
        }

        /* Input */
        .modern-input {
            width: 100%;
            padding: 0.7rem 1rem;
            font-size: 0.95rem;
            font-family: inherit;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid #2a2a27;
            border-radius: 14px;
            color: #f5f5f4;
            transition: all 0.25s ease;
            outline: none;
        }

        .modern-input:focus {
            border-color: #f97316;
            background: rgba(255, 255, 255, 0.06);
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.15);
        }

        .modern-input::placeholder {
            color: #5a5a57;
        }

        /* Error */
        .input-error {
            font-size: 0.75rem;
            color: #f87171;
            margin-top: 0.4rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        /* Checkbox */
        .checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin: 1.25rem 0 1.5rem;
        }

        .checkbox-wrapper input[type="checkbox"] {
            width: 1rem;
            height: 1rem;
            accent-color: #f97316;
            border-radius: 4px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid #3a3a37;
            cursor: pointer;
            flex-shrink: 0;
        }

        .checkbox-wrapper label {
            font-size: 0.85rem;
            color: #b0b0ac;
            cursor: pointer;
            user-select: none;
        }

        /* Actions */
        .form-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-top: 0.5rem;
        }

        .forgot-link {
            font-size: 0.85rem;
            color: #8a8a87;
            text-decoration: none;
            transition: color 0.2s;
            font-weight: 500;
        }

        .forgot-link:hover {
            color: #f97316;
        }

        .login-button {
            background: linear-gradient(135deg, #ea580c, #c2410c);
            color: #fff;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 0.7rem 1.8rem;
            border: none;
            border-radius: 40px;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 4px 20px -6px rgba(234, 88, 12, 0.35);
            font-family: inherit;
        }

        .login-button:hover {
            transform: translateY(-2px);
            background: linear-gradient(135deg, #f97316, #ea580c);
            box-shadow: 0 8px 30px -8px rgba(234, 88, 12, 0.5);
        }

        .login-button:active {
            transform: translateY(0px);
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-card {
                padding: 1.75rem 1.25rem;
            }
            .login-header h1 {
                font-size: 1.9rem;
            }
            .form-actions {
                flex-direction: column;
                align-items: stretch;
            }
            .login-button {
                text-align: center;
                justify-content: center;
            }
            .forgot-link {
                text-align: center;
            }
        }

        @media (max-width: 380px) {
            .login-card {
                padding: 1.5rem 1rem;
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

    <!-- Background Glow -->
    <div class="bg-glow" aria-hidden="true"></div>

    <!-- Card -->
    <div class="login-card">

        <div class="login-header">
            <h1>Lucius <span>Artorius</span></h1>
            <p>Masuk ke akun Anda</p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="session-status">
                {{ session('status') }}
            </div>
        @else
            <x-auth-session-status class="mb-4" :status="session('status')" />
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="form-group">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input id="email"
                       class="modern-input"
                       type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required autofocus autocomplete="username"
                       placeholder="alamat@email.com" />
                @error('email')
                    <div class="input-error">⚠️ {{ $message }}</div>
                @else
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password"
                       class="modern-input"
                       type="password"
                       name="password"
                       required autocomplete="current-password"
                       placeholder="••••••••" />
                @error('password')
                    <div class="input-error">⚠️ {{ $message }}</div>
                @else
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="checkbox-wrapper">
                <input id="remember_me" type="checkbox" name="remember">
                <label for="remember_me">{{ __('Remember me') }}</label>
            </div>

            <div class="form-actions">
                @if (Route::has('password.request'))
                    <a class="forgot-link" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
                <button type="submit" class="login-button">
                    {{ __('Log in') }}
                </button>
            </div>
        </form>

    </div>

</body>
</html>