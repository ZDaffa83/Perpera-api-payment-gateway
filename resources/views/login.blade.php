<!DOCTYPE html>
<html lang="id">
<head >
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('Logo1.png') }}" type="image/png" sizes="32x32">

    <title>Halaman Login</title>
    
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    
    <div class="login-page">
        
        <div class="login-form-container">
            
            <div class="frame-72">
              <div class="login">Login</div>
              <div
                class="sambutan_login"
              >
                Selamat datang kembali! Akses semua informasi tanam, perawatan, dan hasil
                panenmu di Website ini.
              </div>
            </div>
            
            <form action="{{ route('login.post') }}" method="POST" class="login-form"> 
                @csrf 
                
                <div class="e-mail">E-mail</div>
                <input 
                    type="email" 
                    name="email" 
                    class="password-email" 
                    placeholder="Masukkan E-mail" 
                    required
                >
                
                <div class="password">Password</div>

                <div class="password-field-wrapper">
                    <input 
                        type="password" 
                        id="password_input" 
                        name="password" 
                        class="password-textbox" 
                        placeholder="Masukkan Password" 
                        required
                    >
                    <span class="toggle-password" onclick="togglePasswordVisibility()">
                        <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#3c4801" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather-eye">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </span>
                </div>
                
                <div class="forgot-password">
                    <a class="fp_text">Forgot Password?</a>
                </div>
                
                <button type="submit" class="login-button">
                    Login
                </button>
            </form>
            
        </div> 
        <img 
            class="login-img" 
            src="{{ asset('images/piclogin.png') }}"
            alt="Latar belakang pertanian"
        />
        
    </div>

{{-- -- SweetAlert2 Script for Login Error -- --}}
@if (session('loginError'))
<script>
    var errorMessage = "{{ session('loginError') }}";
    
    Swal.fire({
        icon: "error",
        title: "Login Gagal!",
        text: errorMessage, 
        
        customClass: {
            confirmButton: 'btn btn-danger'
        }
    });
</script>
@endif
  <script>
    function togglePasswordVisibility() {
        var input = document.getElementById('password_input');
        var toggleContainer = document.querySelector('.toggle-password');
        
        // Ikon digunakan:
        var iconEye = `
            <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#3c4801" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather-eye">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
            </svg>`;

        var iconEyeOff = `
            <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#3c4801" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather-eye-off">
                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.46M12 4c7 0 11 8 11 8a18.45 18.45 0 0 1-5.06 5.46"></path>
                <line x1="1" y1="1" x2="23" y2="23"></line>
                <circle cx="12" cy="12" r="3"></circle>
            </svg>`;
        
        if (input.type === 'password') {
            input.type = 'text';
            // Ganti ikon ke mata terbuka (eye-off)
            toggleContainer.innerHTML = iconEyeOff;
        } else {
            input.type = 'password';
            // Ganti ikon ke mata tertutup (eye)
            toggleContainer.innerHTML = iconEye;
        }
    }
</script>
</body>
</html>