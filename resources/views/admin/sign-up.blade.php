@php
    $errors = session('errors') ?? new \Illuminate\Support\MessageBag;
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Kasir - Kasirku</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { display: flex; height: 100vh; overflow: hidden; }
        .left-section { flex: 1; background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #1e3c72 100%); display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 40px; color: white; position: relative; overflow: hidden; }
        /* Animated Balls */
        .ball { position: absolute; border-radius: 50%; background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(5px); animation: float 20s infinite ease-in-out; }
        .ball1 { width: 80px; height: 80px; top: 10%; left: 10%; animation-duration: 25s; animation-delay: 0s; }
        .ball2 { width: 120px; height: 120px; top: 70%; left: 20%; animation-duration: 30s; animation-delay: 2s; }
        .ball3 { width: 60px; height: 60px; top: 30%; left: 80%; animation-duration: 22s; animation-delay: 4s; }
        .ball4 { width: 100px; height: 100px; top: 60%; left: 70%; animation-duration: 28s; animation-delay: 1s; }
        .ball5 { width: 40px; height: 40px; top: 20%; left: 50%; animation-duration: 20s; animation-delay: 3s; }
        .ball6 { width: 90px; height: 90px; top: 80%; left: 40%; animation-duration: 35s; animation-delay: 5s; }
        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); opacity: 0.3; }
            25% { transform: translate(100px, -100px) rotate(90deg); opacity: 0.6; }
            50% { transform: translate(-50px, -200px) rotate(180deg); opacity: 0.4; }
            75% { transform: translate(-150px, -50px) rotate(270deg); opacity: 0.7; }
        }
        /* Additional floating animation */
        @keyframes floatUp {
            0% { transform: translateY(100vh) scale(0); opacity: 0; }
            10% { opacity: 0.4; }
            90% { opacity: 0.4; }
            100% { transform: translateY(-100vh) scale(1.5); opacity: 0; }
        }
        .floating-ball { position: absolute; border-radius: 50%; background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.05)); animation: floatUp 15s infinite linear; }
        .floating-ball1 { width: 30px; height: 30px; left: 10%; animation-delay: 0s; }
        .floating-ball2 { width: 20px; height: 20px; left: 30%; animation-delay: 3s; }
        .floating-ball3 { width: 40px; height: 40px; left: 50%; animation-delay: 6s; }
        .floating-ball4 { width: 25px; height: 25px; left: 70%; animation-delay: 9s; }
        .floating-ball5 { width: 35px; height: 35px; left: 90%; animation-delay: 12s; }
        .content-wrapper { position: relative; z-index: 10; text-align: center; }
        .left-section h1 { font-size: 2.5rem; margin-bottom: 20px; font-weight: 700; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3); }
        .left-section h2 { font-size: 1.8rem; margin-bottom: 30px; font-weight: 400; text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3); }
        .left-section p { font-size: 1.1rem; line-height: 1.6; max-width: 400px; text-align: center; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3); }
        .back-btn {
            position: absolute;
            top: 24px;
            left: 24px;
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.13);
            color: #fff;
            border: none;
            border-radius: 24px;
            padding: 8px 18px 8px 12px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            z-index: 20;
            text-decoration: none;
            transition: background 0.2s, color 0.2s;
        }
        .back-btn:hover {
            background: rgba(255,255,255,0.25);
            color: #e0e7ff;
        }
        .back-btn svg {
            margin-right: 4px;
        }
        .right-section { flex: 1; display: flex; justify-content: center; align-items: center; background-color: #fff; }
        .login-container { background-color: white; border-radius: 10px; padding: 40px; width: 80%; max-width: 400px; box-shadow: none; }
        .login-container h2 { font-size: 1.8rem; margin-bottom: 30px; color: #333; text-align: center; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; color: #555; font-weight: 500; }
        .form-group input { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem; transition: border-color 0.3s; }
        .form-group input:focus { outline: none; border-color: #1e3c72; }
        .form-options { display: flex; justify-content: space-between; margin-bottom: 25px; font-size: 0.9rem; }
        .remember-me { display: flex; align-items: center; }
        .remember-me input { margin-right: 5px; }
        .forgot-password { color: #1e3c72; text-decoration: none; }
        .forgot-password:hover { text-decoration: underline; }
        .login-btn { width: 100%; padding: 12px; background-color: #1e3c72; color: white; border: none; border-radius: 5px; font-size: 1rem; font-weight: 600; cursor: pointer; transition: background-color 0.3s; }
        .login-btn:hover { background-color: #2a5298; }
        .divider { display: flex; align-items: center; margin: 25px 0; }
        .divider::before, .divider::after { content: ""; flex: 1; height: 1px; background-color: #ddd; }
        .divider span { padding: 0 15px; color: #888; font-size: 0.9rem; }
        .social-login { display: flex; justify-content: center; gap: 20px; margin-bottom: 25px; }
        .social-btn { width: 50px; height: 50px; border-radius: 50%; display: flex; justify-content: center; align-items: center; cursor: pointer; transition: transform 0.2s, box-shadow 0.2s; border: 1px solid #eee; }
        .social-btn:hover { transform: translateY(-3px); box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1); }
        .google-btn { background-color: white; }
        .facebook-btn { background-color: #1877f2; }
        .signup-link { text-align: center; margin-top: 20px; font-size: 0.9rem; color: #555; }
        .signup-link a { color: #1e3c72; text-decoration: none; font-weight: 600; }
        .signup-link a:hover { text-decoration: underline; }
        .notification { position: fixed; top: 20px; right: 20px; padding: 15px 20px; background-color: #4caf50; color: white; border-radius: 5px; box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2); transform: translateX(150%); transition: transform 0.3s ease-out; z-index: 1000; }
        .notification.show { transform: translateX(0); }
        .notification.error { background-color: #f44336; }
        @media (max-width: 768px) { body { flex-direction: column; } .left-section { flex: 0.4; } .right-section { flex: 0.6; } .left-section h1 { font-size: 2rem; } .left-section h2 { font-size: 1.5rem; } }
    </style>
</head>
<body>
    <div class="left-section">
        <a href="/" class="back-btn" title="Kembali ke halaman utama">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12.5 15L7.5 10L12.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Kembali
        </a>
        <!-- Animated Balls -->
        <div class="ball ball1"></div>
        <div class="ball ball2"></div>
        <div class="ball ball3"></div>
        <div class="ball ball4"></div>
        <div class="ball ball5"></div>
        <div class="ball ball6"></div>
        <!-- Floating Balls -->
        <div class="floating-ball floating-ball1"></div>
        <div class="floating-ball floating-ball2"></div>
        <div class="floating-ball floating-ball3"></div>
        <div class="floating-ball floating-ball4"></div>
        <div class="floating-ball floating-ball5"></div>
        <div class="content-wrapper">
            <h1>Kasirku</h1>
            <h2>Daftar Akun Baru</h2>
            <p>Buat akun kasir baru untuk mengelola penjualan dan stok dengan mudah dan aman.</p>
        </div>
    </div>
    <div class="right-section">
        <div class="login-container">
            <h2>Register Kasir</h2>
            @if($errors->any())
                <div class="alert alert-danger py-2">{{ $errors->first() }}</div>
            @endif
            <form method="POST" action="/register" autocomplete="off">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" id="name" name="name" placeholder="Masukkan nama" required value="{{ old('name') }}" autofocus>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Masukkan email" required value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Buat password" required>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password" required>
                </div>
                <button type="submit" class="login-btn">Daftar</button>
            </form>
            <div class="divider">
                <span>atau daftar dengan</span>
            </div>
            <div class="social-login">
                <div class="social-btn google-btn" title="Daftar dengan Google">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                    </svg>
                </div>
                <div class="social-btn facebook-btn" title="Daftar dengan Facebook">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="white">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                </div>
            </div>
            <div class="signup-link">
                Sudah punya akun? <a href="/login">Login</a>
            </div>
        </div>
    </div>
    <div id="notification" class="notification" style="display:none"></div>
    <script>
        // Notifikasi error Laravel
        document.addEventListener('DOMContentLoaded', function() {
            var notif = document.getElementById('notification');
            @if($errors->any())
                notif.textContent = @json($errors->first());
                notif.className = 'notification show error';
                notif.style.display = 'block';
                setTimeout(function(){ notif.classList.remove('show'); notif.style.display = 'none'; }, 3000);
            @endif
            // Tambahkan efek interaktif pada bola
            const balls = document.querySelectorAll('.ball');
            balls.forEach(ball => {
                ball.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.2)';
                    this.style.opacity = '0.8';
                });
                ball.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1)';
                    this.style.opacity = '0.3';
                });
            });
        });
    </script>
</body>
</html>
