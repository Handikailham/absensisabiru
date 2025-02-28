<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Subtes</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-gray-100 py-10">
  <h2 class="text-3xl font-bold text-center text-blue-500 mb-6">Edit Subtes</h2>
  
  <div class="max-w-lg mx-auto bg-white p-6 rounded-md shadow-md">
    <!-- Notifikasi Sukses -->
    @if(session('success'))
      <div class="mb-4 p-3 bg-green-100 text-green-600 rounded">
        {{ session('success') }}
      </div>
    @endif

    <!-- Alert Error -->
    @if($errors->any())
      <div class="mb-4 p-3 bg-red-100 text-red-600 rounded">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('subtes.update', $subtes->id) }}" method="POST" class="space-y-4">
      @csrf
      @method('PUT')

      <!-- Pelatihan -->
      <div>
        <label for="pelatihan_id" class="block text-sm font-medium text-gray-700">Pelatihan</label>
        <select name="pelatihan_id" id="pelatihan_id" required
                class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option value="">Pilih Pelatihan</option>
          @foreach($pelatihans as $pelatihan)
            <option value="{{ $pelatihan->id }}" {{ $subtes->pelatihan_id == $pelatihan->id ? 'selected' : '' }}>
              {{ $pelatihan->nama_pelatihan }}
            </option>
          @endforeach
        </select>
      </div>

      <!-- Nama Subtes -->
      <div>
        <label for="nama_subtes" class="block text-sm font-medium text-gray-700">Nama Subtes</label>
        <input type="text" id="nama_subtes" name="nama_subtes" value="{{ old('nama_subtes', $subtes->nama_subtes) }}" required
               class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <!-- Durasi (menit) -->
      <div>
        <label for="durasi" class="block text-sm font-medium text-gray-700">Durasi (menit)</label>
        <input type="number" id="durasi" name="durasi" value="{{ old('durasi', $subtes->durasi) }}" required
               class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <!-- Urutan -->
      <div>
        <label for="urutan" class="block text-sm font-medium text-gray-700">Urutan</label>
        <input type="number" id="urutan" name="urutan" value="{{ old('urutan', $subtes->urutan) }}" required
               class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <!-- Tombol Aksi -->
      <div class="flex justify-between">
        <a href="{{ route('subtes.index') }}" class="inline-block bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">
          Kembali
        </a>
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-200">
          Update Subtes
        </button>
      </div>
    </form>
  </div>
</body>
</html>
