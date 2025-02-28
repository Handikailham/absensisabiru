<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Riwayat Gaji Saya</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <style>
    body { font-family: 'Inter', sans-serif; }
    /* Background dengan gradient dari blue-500 ke blue-700 dan wave SVG */
    .wave-bg {
      background: linear-gradient(to bottom, #3B82F6, #1D4ED8);
      background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path transform="translate(0,320) scale(1,-1)" fill="%231D4ED8" d="M0,256L40,256C80,256,160,256,240,256C320,256,400,256,480,224C560,192,640,128,720,128C800,128,880,192,960,224C1040,256,1120,256,1200,234.7C1280,213,1360,171,1400,149.3L1440,128L1440,0L1400,0C1360,0,1280,0,1200,0C1120,0,1040,0,960,0C880,0,800,0,720,0C640,0,560,0,480,0C400,0,320,0,240,0C160,0,80,0,40,0L0,0Z"></path></svg>');
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
    }
  </style>
</head>
<body class="wave-bg min-h-screen relative">
  <!-- Navbar -->
  @include('partials.navbar')
  
  <!-- Main Content Container dengan padding bawah untuk mengakomodasi wave di bawah -->
  <div class="max-w-5xl mx-auto px-6 py-10 pb-40">
    <header class="text-center mb-10">
      <h1 class="text-4xl font-bold text-blue-700">Riwayat Gaji Saya</h1>
      <p class="mt-2 text-gray-600">Berikut adalah rincian slip gaji yang telah diterima.</p>
    </header>

    <!-- Looping tiap record gaji (kotak slip gaji tetap sama) -->
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
            <div>
              <!-- Info tambahan jika diperlukan -->
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
  
  <!-- Wave Element di Bawah -->
  <div class="absolute bottom-0 left-0 w-full overflow-hidden" style="height: 150px;">
    <svg class="w-full h-full" viewBox="0 0 1440 320" preserveAspectRatio="none">
      <path fill="#1D4ED8" d="M0,320L40,290.7C80,261,160,203,240,181.3C320,160,400,176,480,186.7C560,197,640,203,720,192C800,181,880,155,960,144C1040,133,1120,139,1200,149.3C1280,160,1360,176,1400,184L1440,192L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path>
    </svg>
  </div>
</body>
</html>
