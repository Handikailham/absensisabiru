<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pelatihan Terdahulu</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-gray-50 min-h-screen">
  <!-- Navbar -->
  <nav class="bg-white shadow sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
      <div class="flex items-center space-x-6">
        <img src="{{ asset('image/sabiru.png') }}" alt="Logo" class="h-10">
        <a href="{{ route('absen.index') }}" class="text-gray-700 hover:text-blue-600 text-lg">Absensi Karyawan</a>
        <a href="{{ route('absen.riwayatgaji') }}" class="text-blue-600 font-bold hover:text-blue-600 text-lg">Riwayat Gaji</a>
        <!-- Dropdown Jadwal Pelatihan -->
        <div x-data="{ open: false }" class="relative">
          <button @click="open = !open" class="flex items-center text-gray-700  text-lg focus:outline-none">
            Jadwal Pelatihan
            <svg class="ml-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div x-show="open" @click.away="open = false" class="absolute left-0 mt-2 w-48 bg-white shadow-lg rounded-md z-10">
            <a href="{{ route('pelatihankaryawan.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-500 hover:text-white">Pelatihan Terbaru</a>
            <a href="{{ route('pelatihankaryawan.requested') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-500 hover:text-white">Pelatihan Saya</a>
          </div>
        </div>
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

  <!-- Main Content -->
  <div class="max-w-5xl mx-auto px-6 py-10">
    <header class="text-center mb-10">
      <h1 class="text-4xl font-bold text-blue-700">Riwayat Gaji Saya</h1>
      <p class="mt-2 text-gray-600">Berikut adalah rincian slip gaji yang telah diterima.</p>
    </header>

    <!-- Looping tiap record gaji -->
    @foreach($gajiRecords as $record)
      <div class="max-w-4xl mx-auto bg-white shadow-xl rounded-lg overflow-hidden my-8 border border-gray-300">
        <!-- Header Slip -->
        <div class="flex justify-between items-center bg-blue-600 p-4">
          <div>
            <h2 class="text-white text-2xl font-bold">Slip Gaji</h2>
            <p class="text-white text-sm">Periode: {{ date('F Y', strtotime($record->tanggal_gajian)) }}</p>
          </div>
          <!-- Logo Perusahaan -->
          <div>
            <img src="{{ asset('image/sabiru.png') }}" alt="Logo Perusahaan" class="h-16 w-auto" style="filter: invert(1);">

          </div>
        </div>

        <!-- Detail Slip -->
        <div class="p-6">
          <div class="grid grid-cols-2 gap-4">
            <div>
              <p class="text-gray-600 font-semibold">Nama Karyawan</p>
              <p class="text-gray-800">{{ Auth::user()->nama }}</p>
            </div>
            <div>
              <p class="text-gray-600 font-semibold">Posisi</p>
              <p class="text-gray-800">{{ optional($record->posisi)->nama_posisi ?? 'N/A' }}</p>
            </div>
          </div>
          <div class="grid grid-cols-2 gap-4 mt-4">
            <div>
              <p class="text-gray-600 font-semibold">Tanggal Gajian</p>
              <p class="text-gray-800">{{ date('d M Y', strtotime($record->tanggal_gajian)) }}</p>
            </div>
            <!-- Tambahan info bila diperlukan, misal: Nomor Slip atau lainnya -->
            <div>
              <!-- Kosongkan atau tambahkan info lain -->
            </div>
          </div>

          <!-- Pembatas -->
          <div class="border-t border-gray-300 my-4"></div>

          <!-- Rincian Gaji -->
          <div class="space-y-2">
            <div class="flex justify-between">
              <span class="text-gray-600">Gaji Pokok</span>
              <span class="text-gray-800 font-semibold">
                {{ auth()->user()->tipe_karyawan == 'magang' ? '0' : number_format(optional($record->posisi)->gaji_pokok, 0, ',', '.') }}
              </span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-600">Tunjangan</span>
              <span class="text-gray-800 font-semibold">{{ number_format(optional($record->posisi)->tunjangan, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-600">Lembur</span>
              <span class="text-gray-800 font-semibold">{{ number_format($record->lembur, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-600">Bonus</span>
              <span class="text-gray-800 font-semibold">{{ number_format($record->bonus, 0, ',', '.') }}</span>
            </div>
          </div>

          <!-- Total Gaji -->
          <div class="border-t border-gray-300 mt-6 pt-4 flex justify-between items-center">
            <span class="text-lg font-bold">Total Gaji</span>
            <span class="text-lg font-bold text-green-600">{{ number_format($record->total_gaji, 0, ',', '.') }}</span>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</body>
</html>
