<!DOCTYPE html>
<html>
<head>
    <title>SupportDesk</title>
</head>
<body>
    <h1>SupportDesk</h1>
    <hr>
    <nav style="display: flex; align-items: center; gap: 10px;">
        <a href="{{ route('tickets.index') }}">Home</a> |
        <a href="{{ route('tickets.create') }}">Buat Tiket Baru</a> |
        <p style="margin: 0;">Hai, {{ auth()->user()->name }}</p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </nav>
    <hr>
    <h2>{{ ($title) }}</h2>
    @yield('content')
</body>
</html>