<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <!-- Include Bootstrap CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
    <!-- Include Bootstrap JS -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
