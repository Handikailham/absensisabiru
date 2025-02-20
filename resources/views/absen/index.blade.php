<!DOCTYPE html>
<html lang="id">
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
<body class="bg-gray-50 min-h-screen">
    <nav class="bg-white shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
          <div class="flex items-center space-x-6">
            <img src="{{ asset('image/sabiru.png') }}" alt="Logo" class="h-10">
            <a href="{{ route('absen.index') }}" class="text-blue-600 font-bold text-lg">Absensi Karyawan</a>
            <a href="{{ route('absen.riwayatgaji') }}" class="text-gray-700 hover:text-blue-600 text-lg">Riwayat Gaji</a>
            <a href="{{ route('pelatihankaryawan.index') }}" class="text-gray-700 hover:text-blue-600 text-lg">Jadwal Pelatihan</a>
          </div>
          <div class="flex items-center space-x-4">
            <span class="text-gray-700">{{ Auth::user()->nama }}</span>
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition duration-300">
                Logout
              </button>
            </form>
          </div>
        </div>
      </nav>
      
      

    <!-- Content -->
    <div class="flex-1 p-6">
        <div class="max-w-5xl mx-auto bg-white shadow-2xl rounded-xl p-8">
            <!-- Success/Error Message -->
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 mb-6 rounded-lg flex items-center">
                    <svg class="w-6 h-6 mr-3 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 text-red-700 p-4 mb-6 rounded-lg flex items-center">
                    <svg class="w-6 h-6 mr-3 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            <!-- Waktu Sekarang & Status Absensi -->
            <div class="grid md:grid-cols-2 gap-8">
                <div class="bg-gradient-to-br from-blue-500 to-indigo-600 text-white p-8 rounded-xl shadow-2xl transform hover:scale-105 transition duration-300">
                    <h2 class="text-xl font-semibold mb-4">Waktu Sekarang</h2>
                    <p id="current-time" class="text-5xl font-bold mb-4"></p>
                    <p class="text-lg opacity-80">{{ now()->translatedFormat('l, d F Y') }}</p>
                </div>

                <!-- Absensi Status -->
                <div class="bg-gray-100 p-8 rounded-xl shadow-2xl">
                    <h3 class="text-xl font-semibold mb-6">Selamat Datang {{ Auth::user()->nama }}</h3>
                    @if ($absenHariIni)
                        <p class="flex items-center text-lg">
                            <span class="mr-2">Status:</span>
                            <span class="px-4 py-2 bg-blue-500 text-white rounded-full">{{ ucfirst($absenHariIni->status) }}</span>
                        </p>
                        <p>Jam Masuk: {{ $absenHariIni->jam_masuk ?? '-' }}</p>
                        <p>Jam Pulang: {{ $absenHariIni->jam_pulang ?? '-' }}</p>
                        @if (!$absenHariIni->jam_pulang && $absenHariIni->status !== 'izin')
                            <form method="POST" action="{{ route('absen.pulang') }}">
                                @csrf
                                <button class="w-full mt-6 bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-200">
                                    Absen Pulang
                                </button>
                            </form>
                        @endif
                    @else
                        <form method="POST" action="{{ route('absen.masuk') }}">
                            @csrf
                            <button class="w-full bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition duration-200">
                                Absen Masuk
                            </button>
                        </form>
                        <a href="{{ route('absen.izin') }}" class="w-full bg-yellow-500 text-white px-6 py-3 rounded-lg hover:bg-yellow-600 transition duration-200 text-center mt-6 block">
                            Ajukan Izin
                        </a>
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
