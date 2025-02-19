<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Tambah Pelatihan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-gray-100 min-h-screen">
  <nav class="bg-white shadow-md">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
      <div class="flex items-center space-x-4">
        <a href="{{ route('admin.tampil') }}" class="text-gray-800 hover:text-blue-600">Data Karyawan</a>
        <a href="{{ route('absen.admin.index') }}" class="text-gray-800 hover:text-blue-600">Data Absensi</a>
        <a href="{{ route('pelatihan.index') }}" class="text-blue-600 font-bold">Data Pelatihan</a>
      </div>
      <div class="flex items-center space-x-4">
        <span class="text-gray-700">{{ Auth::user()->name }}</span>
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition duration-300">Logout</button>
        </form>
      </div>
    </div>
  </nav>

  <div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200 max-w-3xl mx-auto">
      <div class="p-6">
        <h1 class="text-3xl font-semibold text-center text-blue-600 mb-6">Form Tambah Pelatihan</h1>

        <!-- Alert Sukses -->
        @if (session('success'))
          <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 flex items-center">
            {{ session('success') }}
          </div>
        @endif

        <!-- Alert Kesalahan -->
        @if ($errors->any())
          <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
            @foreach ($errors->all() as $error)
              <p>{{ $error }}</p>
            @endforeach
          </div>
        @endif

        <form action="{{ route('pelatihan.store') }}" method="POST">
          @csrf

          <!-- Input Nama Pelatihan -->
          <div class="space-y-2">
            <label for="nama_pelatihan" class="block text-sm font-medium text-gray-700">Nama Pelatihan</label>
            <input type="text" id="nama_pelatihan" name="nama_pelatihan" required 
                   class="w-full py-2 px-4 bg-gray-100 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
          </div>

          <!-- Input Tanggal Pendaftaran -->
          <div class="space-y-2 mt-4">
            <label for="tanggal_pendaftaran" class="block text-sm font-medium text-gray-700">Tanggal Pendaftaran</label>
            <input type="date" id="tanggal_pendaftaran" name="tanggal_pendaftaran" required 
                   class="w-full py-2 px-4 bg-gray-100 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
          </div>

          <!-- Input Tanggal Pelatihan -->
          <div class="space-y-2 mt-4">
            <label for="tanggal_pelatihan" class="block text-sm font-medium text-gray-700">Tanggal Pelatihan</label>
            <input type="date" id="tanggal_pelatihan" name="tanggal_pelatihan" required 
                   class="w-full py-2 px-4 bg-gray-100 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
          </div>

          <!-- Input Alamat Pelatihan -->
          <div class="space-y-2 mt-4">
            <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat Pelatihan</label>
            <input type="text" id="alamat" name="alamat" required 
                   class="w-full py-2 px-4 bg-gray-100 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
          </div>

          <!-- Input Deskripsi Pelatihan -->
          <div class="space-y-2 mt-4">
            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi Pelatihan</label>
            <textarea id="deskripsi" name="deskripsi" rows="3" required
                      class="w-full py-2 px-4 bg-gray-100 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
          </div>

          <!-- Checkbox untuk memilih posisi yang bisa mengakses pelatihan -->
          <div class="space-y-2 mt-4">
            <label class="block text-sm font-medium text-gray-700">Pilih Posisi yang Bisa Mengakses Pelatihan:</label>
            <div class="mt-2">
              @foreach($posisi as $position)
                <div class="flex items-center">
                  <input type="checkbox" name="posisi_ids[]" value="{{ $position->id }}" id="posisi{{ $position->id }}" class="mr-2">
                  <label for="posisi{{ $position->id }}" class="text-gray-700">{{ $position->nama_posisi }}</label>
                </div>
              @endforeach
            </div>
          </div>

          <div class="flex justify-between items-center mt-6">
            <a href="{{ route('pelatihan.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 shadow-md">
              Kembali
            </a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 shadow-md">
              Tambah Pelatihan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
