<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>HASIL TES {{ $pelatihan->nama_pelatihan }}</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Alpine.js (jika diperlukan) -->
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <!-- Inter Font -->
  <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

  <style>
     body {
      font-family: 'Inter', sans-serif;
    }
    /* Wave background dengan container gradient dari blue-500 ke blue-700,
       dan wave berwarna biru solid (blue-700) */
    .wave-bg {
      background: linear-gradient(to bottom, #3B82F6, #1D4ED8);
      background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path transform="translate(0,320) scale(1,-1)" fill="%231D4ED8" d="M0,256L40,256C80,256,160,256,240,256C320,256,400,256,480,224C560,192,640,128,720,128C800,128,880,192,960,224C1040,256,1120,256,1200,234.7C1280,213,1360,171,1400,149.3L1440,128L1440,0L1400,0C1360,0,1280,0,1200,0C1120,0,1040,0,960,0C880,0,800,0,720,0C640,0,560,0,480,0C400,0,320,0,240,0C160,0,80,0,40,0L0,0Z"></path></svg>');
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
    }
    </style>
</head>
<body class="wave-bg min-h-screen flex flex-col">

  <!-- Navbar -->
  @include('partials.navbar')

  <!-- Main Container -->
  <main class="flex-grow">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <!-- Kartu Hasil Tes -->
      <div class="bg-white rounded-xl shadow-md p-6 sm:p-8">
        
        <!-- Judul -->
        <div class="mb-6 text-center">
          <h2 class="text-2xl md:text-3xl font-bold text-gray-800">
            Hasil Pelatihan <br> <br> {{ $pelatihan->nama_pelatihan }} 
          </h2>
        </div>
        
        <!-- Statistik Soal -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
          <!-- Total Soal -->
          <div class="flex flex-col items-center bg-blue-50 p-4 rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7 7h10M7 11h10M7 15h10M5 6h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2z" />
            </svg>
            <p class="text-sm text-gray-500">Total Soal</p>
            <p class="text-xl font-semibold text-gray-800">{{ $hasil->total_soal }}</p>
          </div>

          <!-- Jumlah Benar -->
          <div class="flex flex-col items-center bg-blue-50 p-4 rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-2 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M14 9l-2 2m0 0l-2-2m2 2v8m8-2a2 2 0 01-2 2h-5a2 2 0 01-2-2V5a2 2 0 012-2h3.586a1 1 0 01.707.293l4 4a1 1 0 01.293.707z" />
            </svg>
            <p class="text-sm text-gray-500">Jumlah Benar</p>
            <p class="text-xl font-semibold text-green-600">{{ $hasil->jumlah_benar }}</p>
          </div>

          <!-- Jumlah Salah -->
          <div class="flex flex-col items-center bg-blue-50 p-4 rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12" />
            </svg>
            <p class="text-sm text-gray-500">Jumlah Salah</p>
            <p class="text-xl font-semibold text-red-600">{{ $hasil->jumlah_salah }}</p>
          </div>
        </div>

        <!-- Skor & Progress Bar -->
        @php
          $skor = ($hasil->total_soal > 0)
                  ? ($hasil->jumlah_benar / $hasil->total_soal) * 100
                  : 0;
          $warnaBar = $skor >= 80
                      ? 'bg-green-400'
                      : ($skor >= 50
                         ? 'bg-yellow-400'
                         : 'bg-red-400');
        @endphp
        <div class="mb-6">
          <p class="text-center text-xl font-semibold text-gray-800 mb-2">
            Skor: {{ number_format($skor, 2) }}%
          </p>
          <div class="w-full bg-gray-200 rounded-full h-4">
            <div class="{{ $warnaBar }} h-4 rounded-full"
                 style="width: {{ number_format($skor, 2) }}%"></div>
          </div>
        </div>

        <!-- Status -->
        <div class="flex items-center justify-center mb-6">
          @if($hasil->status == 'kompeten')
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4" />
            </svg>
            <p class="text-xl font-semibold text-gray-800">Status: Kompeten</p>
          @else
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4m0 4h.01" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 2a10 10 0 110 20 10 10 0 010-20z" />
            </svg>
            <p class="text-xl font-semibold text-gray-800">Status: Tidak Kompeten</p>
          @endif
        </div>

        <!-- Informasi Tambahan -->
        <div class="border-t border-gray-200 pt-4 mb-6">
          <div class="flex justify-between text-gray-700">
            <div>
              <p class="text-sm text-gray-500">Tanggal Tes</p>
              <p class="text-lg font-semibold">
                {{ now()->translatedFormat('l, d F Y') }}
              </p>
            </div>
            <div>
              <p class="text-sm text-gray-500">Waktu Pengerjaan Tes</p>
              <p class="text-lg font-semibold pl-9">{{ $hasil->durasi_tes }}</p>
            </div>
          </div>
          <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">
              Terima kasih telah mengikuti tes. Gunakan hasil ini sebagai acuan untuk peningkatan diri Anda.
            </p>
          </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="text-center">
          <a href="{{ route('pelatihankaryawan.index') }}"
             class="inline-flex items-center bg-blue-600 text-white font-bold py-2 px-6 rounded-full shadow hover:bg-blue-700 transition duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Beranda
          </a>
        </div>

      </div>
    </div>
  </main>

</body>
</html>
