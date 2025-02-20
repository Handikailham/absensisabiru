<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Jadwal Pelatihan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
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
        <a href="{{ route('absen.riwayatgaji') }}" class="text-gray-700 hover:text-blue-600 text-lg">Riwayat Gaji</a>
        <a href="{{ route('pelatihankaryawan.index') }}" class="text-blue-600 font-bold text-lg">Jadwal Pelatihan</a>
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
  <div class="max-w-7xl mx-auto px-6 py-10">
    <header class="text-center mb-10">
      <h1 class="text-4xl font-bold text-blue-700">Jadwal Pelatihan</h1>
      <p class="mt-2 text-gray-600">Pilih pelatihan yang Anda minati, atau cek status permintaan yang telah diajukan.</p>
    </header>
    
    @php
      // Pisahkan pelatihan berdasarkan request karyawan
      $requested = $pelatihan->filter(function ($p) {
          return $p->requests->where('karyawan_id', Auth::user()->id)->isNotEmpty();
      });
      $new = $pelatihan->filter(function ($p) {
          return $p->requests->where('karyawan_id', Auth::user()->id)->isEmpty();
      });
    @endphp

    <!-- Section: Pelatihan Terbaru (Belum di-request) -->
    <section class="mb-12">
      <h2 class="text-3xl font-bold text-black mb-6">Pelatihan Terbaru</h2>
      @if($new->isNotEmpty())
      <div class="space-y-8">
        @foreach ($new as $data)
          <div class="relative bg-white rounded-lg shadow-lg border border-gray-300 overflow-hidden transform hover:scale-105 transition duration-300">
            <!-- Background Overlay -->
            <div class="absolute inset-0 bg-gradient-to-br from-white via-gray-50 to-white opacity-50"></div>
            <!-- Logo/Icon di pojok kanan, dengan jarak yang cukup -->
            <div class="absolute top-5 right-5 z-10">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c1.657 0 3 1.343 3 3s-1.343 3-3 3-3-1.343-3-3 1.343-3 3-3z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2v2m0 16v2m10-10h-2M4 12H2m15.364-6.364l-1.414 1.414M6.05 17.95l-1.414 1.414m12.728 0l1.414-1.414M6.05 6.05L4.636 7.464" />
              </svg>
            </div>
            <div class="relative p-6">
              <h3 class="text-2xl font-bold text-black">{{ $data->nama_pelatihan }}</h3>
              <p class="mt-2 text-gray-600 text-sm"><span class="font-semibold">Pendaftaran:</span> {{ \Carbon\Carbon::parse($data->tanggal_pendaftaran)->format('d-m-Y') }}</p>
              <p class="text-gray-600 text-sm"><span class="font-semibold">Pelatihan:</span> {{ \Carbon\Carbon::parse($data->tanggal_pelatihan)->format('d-m-Y') }}</p>
              <p class="mt-2 text-gray-600 text-sm"><span class="font-semibold">Lokasi:</span> {{ $data->alamat }}</p>
              <p class="mt-3 text-gray-700">{{ $data->deskripsi }}</p>
            </div>
            <div class="relative p-6 bg-gray-50 border-t border-gray-300">
              <form action="{{ route('pelatihan.join', $data->id) }}" method="POST">
                @csrf
                <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white py-2 rounded-lg transition duration-200">
                  Ikuti Pelatihan
                </button>
              </form>
            </div>
          </div>
        @endforeach
      </div>
      @else
      <p class="text-center text-gray-600">Tidak ada pelatihan terbaru untuk saat ini.</p>
      @endif
    </section>

    <hr class="my-8 border-gray-500" />


    <!-- Section: Pelatihan yang Saya Request -->
    @if($requested->isNotEmpty())
    <section>
      <h2 class="text-3xl font-bold text-gray-800 mb-6">Pelatihan Terdahulu</h2>
      <div class="space-y-8">
        @foreach ($requested as $data)
          <div class="relative bg-white rounded-lg shadow-lg border border-gray-300 overflow-hidden transform hover:scale-105 transition duration-300">
            <!-- Background Overlay (Subtle) -->
            <div class="absolute inset-0 bg-gradient-to-br from-gray-50 to-white opacity-50"></div>
            <!-- Logo/Icon di pojok kanan, dengan jarak yang cukup -->
            <div class="absolute top-5 right-5 z-10">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a2 2 0 011.414.586l2.414 2.414A2 2 0 0117.414 6H19a2 2 0 012 2v10a2 2 0 01-2 2z" />
              </svg>
            </div>
            <div class="relative p-6">
              <h3 class="text-2xl font-bold text-gray-800">{{ $data->nama_pelatihan }}</h3>
              <p class="mt-2 text-gray-600 text-sm"><span class="font-semibold">Pendaftaran:</span> {{ \Carbon\Carbon::parse($data->tanggal_pendaftaran)->format('d-m-Y') }}</p>
              <p class="text-gray-600 text-sm"><span class="font-semibold">Pelatihan:</span> {{ \Carbon\Carbon::parse($data->tanggal_pelatihan)->format('d-m-Y') }}</p>
              <p class="mt-2 text-gray-600 text-sm"><span class="font-semibold">Lokasi:</span> {{ $data->alamat }}</p>
              <p class="mt-3 text-gray-700">{{$data->deskripsi }}</p>
            </div>
            <div class="relative p-6 bg-gray-50 border-t border-gray-300 flex justify-end">
              @php
                $req = $data->requests->where('karyawan_id', Auth::user()->id)->first();
              @endphp
              @if($req->status == 'pending')
                <span class="px-4 py-2 text-lg font-semibold text-yellow-600">Menunggu Persetujuan</span>
              @elseif($req->status == 'accepted')
                <span class="px-4 py-2 text-lg font-semibold text-green-600">Diterima</span>
              @elseif($req->status == 'declined')
                <span class="px-4 py-2 text-lg font-semibold text-red-600">Ditolak</span>
              @endif
            </div>
          </div>
        @endforeach
      </div>
    </section>
    @endif

  </div>
</body>
</html>
