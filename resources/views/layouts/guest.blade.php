<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Last Mile Delivery') }} — Login</title>
        <meta name="description" content="Sign in to Last Mile Delivery — Smart logistics management platform">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

        <style>
            /* ===== RESET & BASE ===== */
            *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

            :root {
                --primary: #6C5CE7;
                --primary-dark: #5A4BD1;
                --accent: #00E5A0;
                --accent-glow: rgba(0, 229, 160, 0.4);
                --dark-bg: #0A0E1A;
                --card-bg: rgba(255, 255, 255, 0.03);
                --card-border: rgba(255, 255, 255, 0.06);
                --text: #E8E8F0;
                --text-muted: #7B7D8E;
                --danger: #FF6B6B;
                --glass: rgba(255, 255, 255, 0.04);
                --glass-border: rgba(255, 255, 255, 0.08);
            }

            html, body {
                height: 100%;
                font-family: 'Inter', -apple-system, sans-serif;
                background: var(--dark-bg);
                color: var(--text);
                overflow: hidden;
            }

            /* ===== ANIMATED BACKGROUND ===== */
            .login-wrapper {
                position: relative;
                display: flex;
                height: 100vh;
                width: 100vw;
                overflow: hidden;
            }

            /* Animated gradient orbs */
            .bg-orb {
                position: absolute;
                border-radius: 50%;
                filter: blur(100px);
                opacity: 0.3;
                animation: orbFloat 20s ease-in-out infinite;
                z-index: 0;
            }
            .bg-orb--1 {
                width: 600px; height: 600px;
                background: radial-gradient(circle, var(--primary), transparent 70%);
                top: -200px; left: -100px;
                animation-delay: 0s;
            }
            .bg-orb--2 {
                width: 500px; height: 500px;
                background: radial-gradient(circle, var(--accent), transparent 70%);
                bottom: -150px; right: -100px;
                animation-delay: -7s;
            }
            .bg-orb--3 {
                width: 350px; height: 350px;
                background: radial-gradient(circle, #FF6B9D, transparent 70%);
                top: 50%; left: 50%;
                transform: translate(-50%, -50%);
                animation-delay: -14s;
                opacity: 0.15;
            }

            @keyframes orbFloat {
                0%, 100% { transform: translate(0, 0) scale(1); }
                25% { transform: translate(80px, -60px) scale(1.1); }
                50% { transform: translate(-40px, 80px) scale(0.9); }
                75% { transform: translate(60px, 40px) scale(1.05); }
            }

            /* Grid background pattern */
            .grid-bg {
                position: absolute;
                inset: 0;
                background-image:
                    linear-gradient(rgba(108, 92, 231, 0.03) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(108, 92, 231, 0.03) 1px, transparent 1px);
                background-size: 60px 60px;
                z-index: 0;
            }

            /* Animated delivery path lines */
            .path-lines {
                position: absolute;
                inset: 0;
                z-index: 0;
                overflow: hidden;
            }
            .path-line {
                position: absolute;
                height: 1px;
                background: linear-gradient(90deg, transparent, var(--accent), transparent);
                opacity: 0.15;
                animation: pathMove 8s linear infinite;
            }
            .path-line:nth-child(1) { top: 20%; width: 300px; animation-delay: 0s; }
            .path-line:nth-child(2) { top: 40%; width: 200px; animation-delay: -2s; }
            .path-line:nth-child(3) { top: 60%; width: 400px; animation-delay: -4s; }
            .path-line:nth-child(4) { top: 80%; width: 250px; animation-delay: -6s; }
            .path-line:nth-child(5) { top: 30%; width: 350px; animation-delay: -3s; }

            @keyframes pathMove {
                0% { left: -400px; }
                100% { left: calc(100% + 400px); }
            }

            /* Floating delivery icons */
            .float-icon {
                position: absolute;
                font-size: 20px;
                opacity: 0.06;
                animation: iconFloat 15s ease-in-out infinite;
                z-index: 0;
            }
            .float-icon:nth-child(1) { top: 15%; left: 10%; animation-delay: 0s; font-size: 28px; }
            .float-icon:nth-child(2) { top: 70%; left: 20%; animation-delay: -3s; font-size: 22px; }
            .float-icon:nth-child(3) { top: 25%; right: 15%; animation-delay: -6s; font-size: 32px; }
            .float-icon:nth-child(4) { bottom: 20%; right: 25%; animation-delay: -9s; font-size: 24px; }
            .float-icon:nth-child(5) { top: 50%; left: 5%; animation-delay: -12s; font-size: 18px; }
            .float-icon:nth-child(6) { bottom: 35%; left: 35%; animation-delay: -4s; font-size: 26px; }

            @keyframes iconFloat {
                0%, 100% { transform: translateY(0) rotate(0deg); }
                33% { transform: translateY(-30px) rotate(5deg); }
                66% { transform: translateY(20px) rotate(-5deg); }
            }

            /* ===== LEFT PANEL — BRANDING ===== */
            .brand-panel {
                flex: 1;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 60px;
                position: relative;
                z-index: 1;
            }

            .brand-content {
                max-width: 480px;
                text-align: center;
            }

            .brand-badge {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                background: var(--glass);
                border: 1px solid var(--glass-border);
                border-radius: 50px;
                padding: 8px 20px;
                font-size: 12px;
                font-weight: 500;
                letter-spacing: 1.5px;
                text-transform: uppercase;
                color: var(--accent);
                margin-bottom: 32px;
                backdrop-filter: blur(10px);
            }
            .brand-badge i { font-size: 14px; }

            .brand-logo {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 16px;
                margin-bottom: 24px;
            }

            .logo-icon {
                width: 64px;
                height: 64px;
                background: linear-gradient(135deg, var(--primary), var(--accent));
                border-radius: 16px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 28px;
                color: white;
                box-shadow: 0 8px 32px rgba(108, 92, 231, 0.3);
                position: relative;
                overflow: hidden;
            }
            .logo-icon::before {
                content: '';
                position: absolute;
                inset: 0;
                background: linear-gradient(135deg, transparent 40%, rgba(255,255,255,0.15));
            }

            .brand-title {
                font-family: 'Space Grotesk', sans-serif;
                font-size: 32px;
                font-weight: 700;
                line-height: 1;
            }
            .brand-title span {
                background: linear-gradient(135deg, var(--text) 0%, var(--accent) 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .brand-subtitle {
                font-size: 16px;
                color: var(--text-muted);
                line-height: 1.6;
                margin-bottom: 48px;
            }

            /* Stat cards in branding area */
            .brand-stats {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 16px;
                width: 100%;
            }
            .stat-pill {
                background: var(--glass);
                border: 1px solid var(--glass-border);
                border-radius: 16px;
                padding: 20px 16px;
                text-align: center;
                backdrop-filter: blur(10px);
                transition: all 0.3s ease;
            }
            .stat-pill:hover {
                border-color: rgba(108, 92, 231, 0.3);
                transform: translateY(-4px);
                box-shadow: 0 8px 24px rgba(108, 92, 231, 0.1);
            }
            .stat-pill .stat-number {
                font-family: 'Space Grotesk', sans-serif;
                font-size: 28px;
                font-weight: 700;
                background: linear-gradient(135deg, var(--primary), var(--accent));
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }
            .stat-pill .stat-label {
                font-size: 11px;
                color: var(--text-muted);
                text-transform: uppercase;
                letter-spacing: 1px;
                margin-top: 4px;
            }

            /* ===== RIGHT PANEL — LOGIN FORM ===== */
            .form-panel {
                width: 520px;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 40px;
                position: relative;
                z-index: 1;
            }

            .login-card {
                width: 100%;
                max-width: 420px;
                background: rgba(15, 20, 40, 0.6);
                border: 1px solid var(--glass-border);
                border-radius: 24px;
                padding: 48px 40px;
                backdrop-filter: blur(40px);
                box-shadow: 0 24px 80px rgba(0, 0, 0, 0.4);
                position: relative;
                overflow: hidden;
            }
            .login-card::before {
                content: '';
                position: absolute;
                top: 0; left: 0; right: 0;
                height: 2px;
                background: linear-gradient(90deg, transparent, var(--primary), var(--accent), transparent);
            }

            .login-header {
                margin-bottom: 36px;
            }
            .login-header h1 {
                font-family: 'Space Grotesk', sans-serif;
                font-size: 26px;
                font-weight: 700;
                margin-bottom: 8px;
            }
            .login-header p {
                color: var(--text-muted);
                font-size: 14px;
            }

            /* Session status */
            .session-status {
                background: rgba(0, 229, 160, 0.08);
                border: 1px solid rgba(0, 229, 160, 0.2);
                border-radius: 12px;
                padding: 12px 16px;
                margin-bottom: 20px;
                font-size: 13px;
                color: var(--accent);
            }

            /* Form groups */
            .form-group {
                margin-bottom: 24px;
            }
            .form-group label {
                display: block;
                font-size: 13px;
                font-weight: 500;
                color: var(--text-muted);
                margin-bottom: 8px;
                letter-spacing: 0.3px;
            }
            .input-wrapper {
                position: relative;
            }
            .input-wrapper i {
                position: absolute;
                left: 16px;
                top: 50%;
                transform: translateY(-50%);
                color: var(--text-muted);
                font-size: 14px;
                transition: color 0.3s;
                z-index: 2;
            }
            .form-input {
                width: 100%;
                height: 52px;
                background: rgba(255, 255, 255, 0.04);
                border: 1px solid rgba(255, 255, 255, 0.08);
                border-radius: 14px;
                padding: 0 16px 0 44px;
                font-size: 14px;
                color: var(--text);
                font-family: 'Inter', sans-serif;
                outline: none;
                transition: all 0.3s ease;
            }
            .form-input::placeholder {
                color: rgba(123, 125, 142, 0.6);
            }
            .form-input:focus {
                border-color: var(--primary);
                background: rgba(108, 92, 231, 0.05);
                box-shadow: 0 0 0 3px rgba(108, 92, 231, 0.1);
            }
            .form-input:focus ~ i,
            .form-input:focus + i {
                color: var(--primary);
            }
            .input-wrapper:focus-within i {
                color: var(--primary);
            }

            /* Error messages */
            .input-error {
                margin-top: 6px;
                font-size: 12px;
                color: var(--danger);
            }
            .input-error ul { list-style: none; }
            .input-error li { margin-top: 2px; }

            /* Remember me & Forgot */
            .form-options {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 28px;
            }
            .remember-label {
                display: flex;
                align-items: center;
                gap: 8px;
                font-size: 13px;
                color: var(--text-muted);
                cursor: pointer;
            }
            .remember-label input[type="checkbox"] {
                -webkit-appearance: none;
                appearance: none;
                width: 18px;
                height: 18px;
                background: rgba(255, 255, 255, 0.04);
                border: 1px solid rgba(255, 255, 255, 0.12);
                border-radius: 5px;
                cursor: pointer;
                position: relative;
                transition: all 0.2s;
            }
            .remember-label input[type="checkbox"]:checked {
                background: var(--primary);
                border-color: var(--primary);
            }
            .remember-label input[type="checkbox"]:checked::after {
                content: '✓';
                position: absolute;
                inset: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 11px;
                color: white;
                font-weight: 700;
            }
            .forgot-link {
                font-size: 13px;
                color: var(--primary);
                text-decoration: none;
                font-weight: 500;
                transition: color 0.2s;
            }
            .forgot-link:hover {
                color: var(--accent);
            }

            /* Login button */
            .btn-login {
                width: 100%;
                height: 52px;
                background: linear-gradient(135deg, var(--primary), var(--primary-dark));
                border: none;
                border-radius: 14px;
                color: white;
                font-size: 15px;
                font-weight: 600;
                font-family: 'Inter', sans-serif;
                cursor: pointer;
                position: relative;
                overflow: hidden;
                transition: all 0.3s ease;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                letter-spacing: 0.3px;
            }
            .btn-login::before {
                content: '';
                position: absolute;
                inset: 0;
                background: linear-gradient(135deg, var(--accent), #00C98D);
                opacity: 0;
                transition: opacity 0.4s ease;
            }
            .btn-login:hover::before { opacity: 1; }
            .btn-login:hover {
                transform: translateY(-2px);
                box-shadow: 0 12px 40px rgba(108, 92, 231, 0.35);
            }
            .btn-login:active { transform: translateY(0); }
            .btn-login span,
            .btn-login i { position: relative; z-index: 1; }

            /* Divider */
            .divider {
                display: flex;
                align-items: center;
                margin: 28px 0;
                gap: 16px;
            }
            .divider::before, .divider::after {
                content: '';
                flex: 1;
                height: 1px;
                background: rgba(255, 255, 255, 0.06);
            }
            .divider span {
                font-size: 12px;
                color: var(--text-muted);
                text-transform: uppercase;
                letter-spacing: 1px;
            }

            /* Register link */
            .register-link {
                text-align: center;
                font-size: 14px;
                color: var(--text-muted);
            }
            .register-link a {
                color: var(--accent);
                text-decoration: none;
                font-weight: 600;
                transition: color 0.2s;
            }
            .register-link a:hover {
                color: var(--primary);
            }

            /* ===== PULSE DOT (online indicator) ===== */
            .pulse-dot {
                width: 8px; height: 8px;
                background: var(--accent);
                border-radius: 50%;
                display: inline-block;
                animation: pulse 2s ease-in-out infinite;
            }
            @keyframes pulse {
                0%, 100% { box-shadow: 0 0 0 0 var(--accent-glow); }
                50% { box-shadow: 0 0 0 8px transparent; }
            }

            /* ===== RESPONSIVE ===== */
            @media (max-width: 960px) {
                .login-wrapper { flex-direction: column; }
                .brand-panel { padding: 40px 30px 20px; flex: none; }
                .brand-content { max-width: 100%; }
                .brand-stats { display: none; }
                .brand-subtitle { margin-bottom: 20px; }
                .form-panel { width: 100%; flex: 1; padding: 20px; }
                .login-card { padding: 32px 24px; }
            }
        </style>
    </head>
    <body>
        <div class="login-wrapper">
            <!-- Animated Background -->
            <div class="grid-bg"></div>
            <div class="bg-orb bg-orb--1"></div>
            <div class="bg-orb bg-orb--2"></div>
            <div class="bg-orb bg-orb--3"></div>

            <div class="path-lines">
                <div class="path-line"></div>
                <div class="path-line"></div>
                <div class="path-line"></div>
                <div class="path-line"></div>
                <div class="path-line"></div>
            </div>

            <div class="float-icon"><i class="fa-solid fa-truck-fast"></i></div>
            <div class="float-icon"><i class="fa-solid fa-box"></i></div>
            <div class="float-icon"><i class="fa-solid fa-route"></i></div>
            <div class="float-icon"><i class="fa-solid fa-map-pin"></i></div>
            <div class="float-icon"><i class="fa-solid fa-warehouse"></i></div>
            <div class="float-icon"><i class="fa-solid fa-barcode"></i></div>

            <!-- Left Panel — Brand -->
            <div class="brand-panel">
                <div class="brand-content">
                    <div class="brand-badge">
                        <span class="pulse-dot"></span>
                        Logistics Platform
                    </div>
                    <div class="brand-logo">
                        <div class="logo-icon">
                            <i class="fa-solid fa-truck-fast"></i>
                        </div>
                        <div class="brand-title"><span>LastMile</span></div>
                    </div>
                    <p class="brand-subtitle">
                        Smart routing, real-time tracking & fleet management — all in one powerful platform for last-mile delivery excellence.
                    </p>

                    <div class="brand-stats">
                        <div class="stat-pill">
                            <div class="stat-number">98%</div>
                            <div class="stat-label">On-Time</div>
                        </div>
                        <div class="stat-pill">
                            <div class="stat-number">10K+</div>
                            <div class="stat-label">Deliveries</div>
                        </div>
                        <div class="stat-pill">
                            <div class="stat-number">50+</div>
                            <div class="stat-label">Cities</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Panel — Login Card -->
            <div class="form-panel">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
