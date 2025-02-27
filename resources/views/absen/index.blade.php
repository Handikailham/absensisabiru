<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Absensi Karyawan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-gray-50 h-screen flex flex-col overflow-hidden">
  <!--navbar-->
  @include('partials.navbar')  
  <!-- Toast Notification Simple (pojok kanan atas) -->
  @if(session('success'))
    <div class="fixed top-4 right-4 z-50" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
      <div class="bg-green-200 text-green-800 text-sm px-3 py-2 rounded shadow">
        {{ session('success') }}
      </div>
    </div>
  @endif

  @if(session('error'))
    <div class="fixed top-4 right-4 z-50" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
      <div class="bg-red-200 text-red-800 text-sm px-3 py-2 rounded shadow">
        {{ session('error') }}
      </div>
    </div>
  @endif

  <!-- Main Content: Absensi -->
  <div class="flex-1 flex items-center justify-center">
    <div class="flex flex-col items-center space-y-8">
      <!-- Waktu Sekarang Card -->
      <div class="bg-gradient-to-br from-blue-500 to-blue-700 text-white p-8 rounded-full shadow-2xl transform transition duration-300 hover:scale-105 text-center">
        <h2 class="text-2xl font-bold mb-2">Waktu Sekarang</h2>
        <p id="current-time" class="text-5xl font-bold mb-2"></p>
        <p class="text-lg opacity-90">{{ now()->translatedFormat('l, d F Y') }}</p>
      </div>
      <!-- Kartu Absensi -->
      <div class="bg-white rounded-2xl shadow-xl p-8 w-full max-w-md">
        <h3 class="text-2xl font-bold text-gray-800 text-center mb-4">Selamat Datang, {{ Auth::user()->nama }}</h3>
        <div class="flex justify-around mb-4">
          <div class="flex flex-col items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-500 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20a8 8 0 100-16 8 8 0 000 16z" />
            </svg>
            <p class="text-sm text-gray-600">Jam Masuk</p>
            <p class="text-base font-medium text-gray-800">{{ $absenHariIni->jam_masuk ?? '-' }}</p>
          </div>
          <div class="flex flex-col items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-500 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20a8 8 0 100-16 8 8 0 000 16z" />
            </svg>
            <p class="text-sm text-gray-600">Jam Pulang</p>
            <p class="text-base font-medium text-gray-800">{{ $absenHariIni->jam_pulang ?? '-' }}</p>
          </div>
        </div>
        <div class="text-center">
          @if ($absenHariIni)
            <div class="flex flex-col items-center space-y-3">
              <div class="flex items-center space-x-2 mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span class="text-base font-semibold text-gray-700">{{ ucfirst($absenHariIni->status) }}</span>
              </div>
              @if (!$absenHariIni->jam_pulang && $absenHariIni->status !== 'izin')
                <form method="POST" action="{{ route('absen.pulang') }}">
                  @csrf
                  <button type="submit" class="flex items-center space-x-2 bg-blue-500 text-white px-5 py-2 rounded-full hover:bg-blue-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <span class="text-sm">Absen Pulang</span>
                  </button>
                </form>
              @endif
            </div>
          @else
            <div class="flex justify-around">
              <form id="formAbsenMasuk" method="POST" action="{{ route('absen.masuk') }}" onsubmit="return checkTime();">
                @csrf
                <button type="submit" class="flex items-center space-x-2 bg-blue-500 text-white px-5 py-2 rounded-full hover:bg-blue-600 transition">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                  </svg>
                  <span class="text-sm">Absen Masuk</span>
                </button>
              </form>
              <a href="{{ route('absen.izin') }}" class="flex items-center space-x-2 bg-blue-400 text-white px-5 py-2 rounded-full hover:bg-blue-500 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20a8 8 0 100-16 8 8 0 000 16z" />
                </svg>
                <span class="text-sm">Ajukan Izin</span>
              </a>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>

  <script>
    // Update waktu secara real-time
    function updateTime() {
      const now = new Date();
      const options = { hour: '2-digit', minute: '2-digit', second: '2-digit' };
      document.getElementById('current-time').textContent = now.toLocaleTimeString('id-ID', options);
    }
    setInterval(updateTime, 1000);
    updateTime();

    // Fungsi validasi waktu untuk Absen Masuk
    function checkTime() {
      const now = new Date();
      if (now.getHours() < 10) {
        alert("Belum jam 10, tidak bisa absen");
        return false;
      }
      return true;
    }
  </script>
</body>
</html>
