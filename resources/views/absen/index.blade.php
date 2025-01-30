<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Absen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            document.getElementById('current-time').innerText = `${hours}:${minutes}:${seconds}`;
        }
        setInterval(updateClock, 1000);
        window.onload = updateClock;
    </script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Absensi Karyawan</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1>Halaman Absen</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <p><strong>Waktu Sekarang:</strong> <span id="current-time"></span></p>
        <p>Halo, {{ $karyawan->nama }}</p>
        <p>Tanggal: {{ now()->toDateString() }}</p>

        @if ($absenHariIni)
            <p>Status: {{ ucfirst($absenHariIni->status) }}</p>
            <p>Jam Masuk: {{ $absenHariIni->jam_masuk ?? '-' }}</p>
            <p>Jam Pulang: {{ $absenHariIni->jam_pulang ?? '-' }}</p>

            @if (!$absenHariIni->jam_pulang)
                <form method="POST" action="{{ route('absen.pulang') }}">
                    @csrf
                    <button class="btn btn-primary">Absen Pulang</button>
                </form>
            @endif
        @else
            <form method="POST" action="{{ route('absen.masuk') }}">
                @csrf
                <button class="btn btn-success">Absen Masuk</button>
            </form>
            <form method="POST" action="{{ route('absen.izin') }}">
                @csrf
                <button class="btn btn-warning">Ajukan Izin</button>
            </form>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
