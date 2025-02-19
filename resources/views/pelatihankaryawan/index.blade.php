<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Pelatihan Karyawan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-gray-50 min-h-screen">
  <nav class="bg-white shadow-lg sticky top-0 z-10">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
      <!-- Logo and Links -->
      <div class="flex items-center space-x-6">
        <!-- Logo -->
        <img src="{{ asset('image/sabiru.png') }}" alt="Logo" class="h-12">
        
        <a href="{{ route('absen.index') }}" class="text-gray-800 hover:text-blue-600 {{ request()->routeIs('absen.index') ? 'font-bold text-blue-600' : '' }} text-lg">
          Absensi Karyawan
        </a>
        <a href="{{ route('absen.riwayatgaji') }}" class="text-gray-800 hover:text-blue-600 {{ request()->routeIs('absen.riwayatgaji') ? 'font-bold text-blue-600' : '' }} text-lg">
          Riwayat Gaji
        </a>
        <a href="{{ route('pelatihankaryawan.index') }}" class="text-gray-800 hover:text-blue-600 {{ request()->routeIs('pelatihankaryawan.index') ? 'font-bold text-blue-600' : '' }} text-lg">
          Pelatihan Karyawan
        </a>
      </div>
  </nav>

  <div class="container mx-auto px-6 py-8">
    <!-- Card for content -->
    <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200">
      <div class="p-6">
        <h1 class="text-3xl font-semibold text-center text-blue-600 mb-6">Data Pelatihan</h1>

        <!-- Alert Success (if any) -->
        @if (session('success'))
          <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
            {{ session('success') }}
          </div>
        @endif

        <!-- Display training data as cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          @foreach ($pelatihan as $no => $data)
            <div class="bg-white shadow-xl rounded-lg p-6 border border-gray-300">
              <h3 class="text-xl font-semibold text-blue-600">{{ $data->nama_pelatihan }}</h3>
              <p class="text-gray-600 mt-2">Tanggal Pendaftaran: {{ \Carbon\Carbon::parse($data->tanggal_pendaftaran)->format('d-m-Y') }}</p>
              <p class="text-gray-600">Tanggal Pelatihan: {{ \Carbon\Carbon::parse($data->tanggal_pelatihan)->format('d-m-Y') }}</p>
              <p class="text-gray-600 mt-2">Alamat: {{ $data->alamat }}</p>
              <p class="text-gray-600 mt-2">{{ Str::limit($data->deskripsi, 100) }}</p>

              <div class="mt-4">
                @php
                  // Get request submitted by the employee for this training
                  $req = $data->requests->where('karyawan_id', Auth::user()->id)->first();
                @endphp

                @if($req)
                  @if($req->status == 'pending')
                    <span class="text-yellow-500 font-semibold">Menunggu Persetujuan</span>
                  @elseif($req->status == 'accepted')
                    <span class="text-green-500 font-semibold">Permintaan Diterima</span>
                  @elseif($req->status == 'declined')
                    <span class="text-red-500 font-semibold">Permintaan Ditolak</span>
                  @endif
                @else
                  <form action="{{ route('pelatihan.join', $data->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-200">
                      Ikuti Pelatihan
                    </button>
                  </form>
                @endif
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</body>
</html>
