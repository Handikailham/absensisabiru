<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Tambah Posisi</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-gray-100 py-10">
  <h2 class="text-3xl font-bold text-center text-blue-500 mb-6">Form Tambah Posisi</h2>
  
  <div class="max-w-lg mx-auto bg-white p-6 rounded-md shadow-md">
    <!-- Alert Sukses -->
    @if (session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 flex items-center">
        {{ session('success') }}
      </div>
    @endif

    <!-- Alert Error -->
    @if ($errors->any())
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
        @foreach ($errors->all() as $error)
          <p>{{ $error }}</p>
        @endforeach
      </div>
    @endif

    <form action="{{ route('posisi.store') }}" method="POST" class="space-y-4">
      @csrf

      <!-- Nama Posisi -->
      <div>
        <label for="nama_posisi" class="block text-sm font-medium text-gray-700">Nama Posisi</label>
        <input type="text" id="nama_posisi" name="nama_posisi" required 
          class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <!-- Gaji Pokok -->
      <div>
        <label for="gaji_pokok" class="block text-sm font-medium text-gray-700">Gaji Pokok</label>
        <input type="number" step="0.01" id="gaji_pokok" name="gaji_pokok" required 
          class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <!-- Tunjangan -->
      <div>
        <label for="tunjangan" class="block text-sm font-medium text-gray-700">Tunjangan</label>
        <input type="number" step="0.01" id="tunjangan" name="tunjangan" required 
          class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <div class="flex justify-between">
        <a href="{{ route('posisi.index') }}" class="inline-block bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">
          Kembali
        </a>
        <button type="submit" class="inline-block bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">
          Tambah
        </button>
      </div>
    </form>
  </div>
</body>
</html>
