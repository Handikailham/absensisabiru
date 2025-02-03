<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Karyawan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-100 via-white to-blue-100 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-4xl bg-white shadow-2xl rounded-3xl overflow-hidden border border-blue-100">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-6">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <svg class="w-10 h-10 mr-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                    </svg>
                    <h1 class="text-3xl font-bold text-white">Absensi Karyawan</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition duration-300 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 1.293a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 01-1.414-1.414L14.586 11H7a1 1 0 110-2h7.586l-1.293-1.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="p-6">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-3 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-3 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif
            
            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-gradient-to-br from-blue-500 to-indigo-600 text-white p-6 rounded-2xl shadow-lg">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold">Waktu Sekarang</h2>
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <p id="current-time" class="text-5xl font-bold mb-2"></p>
                    <p class="text-lg opacity-80">{{ now()->translatedFormat('l, d F Y') }}</p>
                </div>

                <div class="flex flex-col space-y-4">
                    <div class="bg-blue-50 p-4 rounded-xl text-center">
                        <p class="text-lg font-medium text-blue-800">
                            Selamat Datang, 
                            <span class="font-bold text-blue-600">{{ $karyawan->nama }}</span>
                        </p>
                    </div>

                    @if ($absenHariIni)
    <div class="bg-gray-100 p-4 rounded-2xl shadow-md">
        <h3 class="text-lg font-semibold mb-2">Status Absensi Hari Ini</h3>
        <div class="space-y-2">
            <p class="flex items-center">
                <span class="mr-2">Status:</span>
                <span class="px-2 py-1 bg-blue-500 text-white rounded-full text-sm">
                    {{ ucfirst($absenHariIni->status) }}
                </span>
            </p>
            <p>Jam Masuk: {{ $absenHariIni->jam_masuk ?? '-' }}</p>
            <p>Jam Pulang: {{ $absenHariIni->jam_pulang ?? '-' }}</p>
        </div>
    </div>

    @if (!$absenHariIni->jam_pulang && $absenHariIni->status !== 'izin')
        <form method="POST" action="{{ route('absen.pulang') }}">
            @csrf
            <button class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                Absen Pulang
            </button>
        </form>
    @endif
@else
    <div class="flex flex-col space-y-2">
        <form method="POST" action="{{ route('absen.masuk') }}">
            @csrf
            <button class="w-full bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-300">
                Absen Masuk
            </button>
        </form>
        <a href="{{ route('absen.izin') }}" class="w-full bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition duration-300 text-center block">
            Ajukan Izin
        </a>           
    </div>
@endif

                </div>
            </div>
        </div>
    </div>
    <script>
        function updateTime() {
            const now = new Date();
            const options = { hour: '2-digit', minute: '2-digit', second: '2-digit' };
            document.getElementById('current-time').textContent = now.toLocaleTimeString('id-ID', options);
        }
        setInterval(updateTime, 1000);
        updateTime();
    </script>
</body>
</html>