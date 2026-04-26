{{-- resources/views/layouts/agrisense_master.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgriSmart | @yield('title', 'Dashboard')</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    {{-- CSS Kustom --}}
    <link href="{{ asset('css/dbcss.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @stack('styles')
</head>
<body>

    {{-- Container dibuat fluid di layar kecil agar tidak terlalu sempit --}}
    <div class="container-md mt-3 mt-md-4 mb-4">
        
        {{-- Header Responsif --}}
        <header class="agrisense-header mb-4 d-flex align-items-center justify-content-between flex-wrap p-3">
            <div class="agrisense-logo fs-4 fw-bold">AgriSmart</div>
            
            {{-- Navigasi akan bergeser ke tengah/bawah jika layar sangat kecil --}}
            <nav class="agrisense-nav d-flex gap-3 my-2 my-md-0">
                <a href="{{ url('/dashboard') }}" class="text-decoration-none">Home</a>
                <a href="{{ route('helpdesk') }}" class="text-decoration-none">Help Desk</a>
            </nav>

            <div class="notification-icon">
                <i class="fas fa-bell fs-5"></i>
            </div>
        </header>

        {{-- Konten Dinamis --}}
        <main>
            @yield('content')
        </main>

        {{-- Footer --}}
        @include('layouts.footer')

    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/dashjs.js') }}"></script>
    @stack('scripts')
</body>
</html>