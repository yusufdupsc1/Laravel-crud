<!DOCTYPE html>
<html>
<head>
    <title>Laravel CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  
<div class="container mt-5">
    @yield('content')
</div>
   
<div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2"></div>

@vite(['resources/js/app.js'])

<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('success'))
            window.showToast('{{ session('success') }}', 'success');
        @endif

        @if(session('error'))
            window.showToast('{{ session('error') }}', 'error');
        @endif

        @if(session('warning'))
            window.showToast('{{ session('warning') }}', 'warning');
        @endif

        @if(session('info'))
            window.showToast('{{ session('info') }}', 'info');
        @endif
    });
</script>
</body>
</html>