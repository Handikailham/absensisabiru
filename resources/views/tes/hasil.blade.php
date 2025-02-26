<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HASIL TES {{ $pelatihan->nama_pelatihan }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-gray-100">
  <div class="container mx-auto py-10 px-4">
    <div class="max-w-xl mx-auto bg-white rounded-lg shadow-lg p-8 transform transition-all duration-500 ease-in-out hover:scale-105">
      <h2 class="text-3xl font-semibold text-gray-800 text-center mb-6 animate__animated animate__fadeIn">
        HASIL TES {{ $pelatihan->nama_pelatihan }}
      </h2>
      
      <div class="mb-8">
        <div class="flex justify-between border-b pb-2 mb-3 animate__animated animate__fadeInLeft">
          <span class="text-gray-600">Total Soal</span>
          <span class="font-semibold text-gray-800">{{ $hasil->total_soal }}</span>
        </div>
        <div class="flex justify-between border-b pb-2 mb-3 animate__animated animate__fadeInLeft">
          <span class="text-gray-600">Jumlah Benar</span>
          <span class="font-semibold text-green-600">{{ $hasil->jumlah_benar }}</span>
        </div>
        <div class="flex justify-between animate__animated animate__fadeInLeft">
          <span class="text-gray-600">Jumlah Salah</span>
          <span class="font-semibold text-red-600">{{ $hasil->jumlah_salah }}</span>
        </div>
      </div>

      <!-- Skor & Progress Bar -->
      <div class="mb-8 animate__animated animate__fadeIn">
        <p class="text-xl font-semibold text-gray-800 text-center mb-4">
          Skor: {{ number_format(($hasil->total_soal > 0 ? ($hasil->jumlah_benar / $hasil->total_soal) * 100 : 0), 2) }}%
        </p>
        <div class="w-full bg-gray-200 rounded-full h-2.5 mb-4">
          <div class="bg-blue-500 h-2.5 rounded-full" style="width: {{ number_format(($hasil->total_soal > 0 ? ($hasil->jumlah_benar / $hasil->total_soal) * 100 : 0), 2) }}%"></div>
        </div>
      </div>

      <!-- Status -->
      <div class="mb-6 text-center animate__animated animate__fadeInUp">
        <p class="text-lg font-medium {{ $hasil->status == 'kompeten' ? 'text-green-600' : 'text-red-600' }}">
          Status: {{ ucfirst($hasil->status) }}
        </p>
      </div>

      <!-- Button Kembali ke Beranda -->
      <div class="text-center animate__animated animate__fadeInUp">
        <a href="{{ route('pelatihankaryawan.index') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-lg shadow-md transform transition-all duration-300 ease-in-out hover:scale-105">
          Kembali ke Beranda
        </a>
      </div>
    </div>
  </div>
</body>
</html>
