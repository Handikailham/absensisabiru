<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Absensi</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">
  <div class="bg-white rounded-lg shadow p-6 max-w-md w-full">
    <h2 class="text-2xl font-semibold text-blue-600 text-center mb-6">Detail Absensi</h2>
    <div class="space-y-4">
      <!-- Nama Karyawan -->
      <div class="flex items-center border-b pb-2">
        <div class="flex items-center space-x-2">
          <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
               xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5.121 17.804A11.955 11.955 0 0012 20c2.21 0 4.29-.57 6.121-1.596M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
          </svg>
          <span class="text-gray-600">Nama Karyawan</span>
        </div>
        <div class="ml-auto text-gray-800 font-medium">{{ $absen->karyawan->nama }}</div>
      </div>
      <!-- Tanggal -->
      <div class="flex items-center border-b pb-2">
        <div class="flex items-center space-x-2">
          <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
               xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
          </svg>
          <span class="text-gray-600">Tanggal</span>
        </div>
        <div class="ml-auto text-gray-800 font-medium">{{ $absen->tanggal }}</div>
      </div>
      <!-- Jam Masuk -->
      <div class="flex items-center border-b pb-2">
        <div class="flex items-center space-x-2">
          <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
               xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
          <span class="text-gray-600">Jam Masuk</span>
        </div>
        <div class="ml-auto text-gray-800 font-medium">{{ $absen->jam_masuk ?? '-' }}</div>
      </div>
      <!-- Jam Pulang -->
      <div class="flex items-center border-b pb-2">
        <div class="flex items-center space-x-2">
          <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
               xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M17 16l4-4m0 0l-4-4m4 4H7"></path>
          </svg>
          <span class="text-gray-600">Jam Pulang</span>
        </div>
        <div class="ml-auto text-gray-800 font-medium">{{ $absen->jam_pulang ?? '-' }}</div>
      </div>
      <!-- Status -->
      <div class="flex items-center">
        <div class="flex items-center space-x-2">
          <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
               xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 12l2 2 4-4m1-3a9 9 0 11-7.5 15 9 9 0 017.5-15z"></path>
          </svg>
          <span class="text-gray-600">Status</span>
        </div>
        <div class="ml-auto text-gray-800 font-medium">{{ ucfirst($absen->status) }}</div>
      </div>
    </div>
    <div class="mt-8 text-center">
      <a href="{{ route('absen.admin.index') }}" class="inline-block bg-blue-600 text-white py-2 px-6 rounded hover:bg-blue-700 transition">
        Kembali
      </a>
    </div>
  </div>
</body>
</html>
