<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HASIL TES {{ $pelatihan->nama_pelatihan }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-white min-h-screen">
  
  <!-- Navbar -->
  @include('partials.navbar')

  <div class="flex items-center justify-center">
    <div class="max-w-xl w-full mx-auto bg-gradient-to-r from-blue-400 to-blue-600 rounded-lg shadow-lg p-8 text-white">
      <!-- Konten hasil tes seperti sebelumnya -->
      <div class="mb-6 text-center">
        <h2 class="text-3xl font-bold">HASIL TES {{ $pelatihan->nama_pelatihan }}</h2>
      </div>
      
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <!-- Statistik Soal -->
        <div class="flex flex-col items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
              d="M7 7h10M7 11h10M7 15h10M5 6h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2z" />
          </svg>
          <p class="text-sm">Total Soal</p>
          <p class="text-xl font-semibold">{{ $hasil->total_soal }}</p>
        </div>
        <div class="flex flex-col items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-2 text-green-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                  d="M14 9l-2 2m0 0l-2-2m2 2v8m8-2a2 2 0 01-2 2h-5a2 2 0 01-2-2V5a2 2 0 012-2h3.586a1 1 0 01.707.293l4 4a1 1 0 01.293.707z" />
          </svg>
          <p class="text-sm">Jumlah Benar</p>
          <p class="text-xl font-semibold text-green-300">{{ $hasil->jumlah_benar }}</p>
        </div>
        <div class="flex flex-col items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-2 text-red-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                  d="M6 18L18 6M6 6l12 12" />
          </svg>
          <p class="text-sm">Jumlah Salah</p>
          <p class="text-xl font-semibold text-red-300">{{ $hasil->jumlah_salah }}</p>
        </div>
      </div>
      
      <div class="mb-6">
        <p class="text-center text-xl font-semibold mb-2">
          Skor: {{ number_format(($hasil->total_soal > 0 ? ($hasil->jumlah_benar / $hasil->total_soal) * 100 : 0), 2) }}%
        </p>
        @php
          $skor = ($hasil->total_soal > 0) ? ($hasil->jumlah_benar / $hasil->total_soal) * 100 : 0;
          $warnaBar = $skor >= 80 ? 'bg-green-400' : ($skor >= 50 ? 'bg-yellow-400' : 'bg-red-400');
        @endphp
        <div class="w-full bg-blue-200 rounded-full h-4">
          <div class="{{ $warnaBar }} h-4 rounded-full" style="width: {{ number_format($skor, 2) }}%"></div>
        </div>
      </div>
      
      <div class="flex items-center justify-center mb-6">
        @if($hasil->status == 'kompeten')
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-300 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                  d="M9 12l2 2 4-4" />
          </svg>
        @else
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-300 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                  d="M12 8v4m0 4h.01" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                  d="M12 2a10 10 0 110 20 10 10 0 010-20z" />
          </svg>
        @endif
        <p class="text-xl font-semibold">Status: {{ ucfirst($hasil->status) }}</p>
      </div>
      
      <div class="border-t border-blue-200 pt-4 mb-6">
        <div class="flex justify-between">
          <div>
            <p class="text-sm">Tanggal Tes</p>
            <p class="text-lg font-semibold">{{ now()->translatedFormat('l, d F Y') }}</p>
          </div>
          <div>
            <p class="text-sm">Durasi Tes</p>
            <p class="text-lg font-semibold">60 Menit</p>
          </div>
        </div>
        <div class="mt-4 text-center">
          <p class="text-sm">Terima kasih telah mengikuti tes. Gunakan hasil ini sebagai acuan untuk peningkatan diri Anda.</p>
        </div>
      </div>
      
      <div class="text-center">
        <a href="{{ route('pelatihankaryawan.index') }}" class="inline-flex items-center bg-white text-blue-700 font-bold py-2 px-6 rounded-full shadow hover:bg-blue-50 transition duration-300">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                  d="M15 19l-7-7 7-7" />
          </svg>
          Kembali ke Beranda
        </a>
      </div>
      
    </div>
  </div>
  
</body>
</html>
