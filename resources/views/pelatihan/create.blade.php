<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Tambah Pelatihan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-gray-100 py-10">
  <h2 class="text-3xl font-bold text-center text-blue-500 mb-6">Form Tambah Pelatihan</h2>
  
  <div class="max-w-3xl mx-auto bg-white p-6 rounded-md shadow-md">
    <!-- Alert Sukses -->
    @if (session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
      </div>
    @endif

    <!-- Alert Error -->
    @if ($errors->any())
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        @foreach ($errors->all() as $error)
          <p>{{ $error }}</p>
        @endforeach
      </div>
    @endif

    <form action="{{ route('pelatihan.store') }}" method="POST" class="space-y-4">
      @csrf

      <!-- Nama Pelatihan -->
      <div>
        <label for="nama_pelatihan" class="block text-sm font-medium text-gray-700">Nama Pelatihan</label>
        <input type="text" id="nama_pelatihan" name="nama_pelatihan" required 
          class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <!-- Tanggal Pendaftaran -->
      <div>
        <label for="tanggal_pendaftaran" class="block text-sm font-medium text-gray-700">Tanggal Pendaftaran</label>
        <input type="date" id="tanggal_pendaftaran" name="tanggal_pendaftaran" required 
          class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <!-- Tanggal Pelatihan -->
      <div>
        <label for="tanggal_pelatihan" class="block text-sm font-medium text-gray-700">Tanggal Pelatihan</label>
        <input type="date" id="tanggal_pelatihan" name="tanggal_pelatihan" required 
          class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <!-- Waktu Mulai -->
      <div>
        <label for="waktu_mulai" class="block text-sm font-medium text-gray-700">Waktu Mulai</label>
        <input type="time" id="waktu_mulai" name="waktu_mulai" step="1" required 
          class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <!-- Waktu Akhir -->
      <div>
        <label for="waktu_akhir" class="block text-sm font-medium text-gray-700">Waktu Akhir</label>
        <input type="time" id="waktu_akhir" name="waktu_akhir" step="1" required 
          class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <!-- Alamat Pelatihan -->
      <div>
        <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat Pelatihan</label>
        <input type="text" id="alamat" name="alamat" required 
          class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <!-- Deskripsi Pelatihan -->
      <div>
        <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi Pelatihan</label>
        <textarea id="deskripsi" name="deskripsi" rows="3" required
          class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
      </div>

      <!-- Pilih Posisi yang Bisa Mengakses Pelatihan -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Pilih Posisi yang Bisa Mengakses Pelatihan:</label>
        <div class="mt-2 space-y-2">
          @foreach($posisi as $position)
            <div class="flex items-center">
              <input type="checkbox" name="posisi_ids[]" value="{{ $position->id }}" id="posisi{{ $position->id }}" class="mr-2">
              <label for="posisi{{ $position->id }}" class="text-gray-700">{{ $position->nama_posisi }}</label>
            </div>
          @endforeach
        </div>
      </div>

      <!-- Tombol Aksi -->
      <div class="flex justify-between">
        <a href="{{ route('pelatihan.index') }}" class="inline-block bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">
          Kembali
        </a>
        <button type="submit" class="inline-block bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">
          Tambah Pelatihan
        </button>
      </div>
    </form>
  </div>
</body>
</html>
