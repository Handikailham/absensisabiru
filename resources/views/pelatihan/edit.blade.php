<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Pelatihan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-gray-100 min-h-screen">
  <div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200 p-6">
      <h1 class="text-3xl font-semibold text-center text-blue-600 mb-6">Edit Pelatihan</h1>
      <form action="{{ route('pelatihan.update', $pelatihan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label for="nama_pelatihan" class="block text-gray-700">Nama Pelatihan</label>
          <input type="text" name="nama_pelatihan" id="nama_pelatihan" class="w-full border border-gray-300 p-2 rounded" value="{{ old('nama_pelatihan', $pelatihan->nama_pelatihan) }}" required>
        </div>
        <div class="mb-3">
          <label for="tanggal_pendaftaran" class="block text-gray-700">Tanggal Pendaftaran</label>
          <input type="date" name="tanggal_pendaftaran" id="tanggal_pendaftaran" class="w-full border border-gray-300 p-2 rounded" value="{{ old('tanggal_pendaftaran', $pelatihan->tanggal_pendaftaran) }}" required>
        </div>
        <div class="mb-3">
          <label for="tanggal_pelatihan" class="block text-gray-700">Tanggal Pelatihan</label>
          <input type="date" name="tanggal_pelatihan" id="tanggal_pelatihan" class="w-full border border-gray-300 p-2 rounded" value="{{ old('tanggal_pelatihan', $pelatihan->tanggal_pelatihan) }}" required>
        </div>
        <div class="mb-3">
          <label for="alamat" class="block text-gray-700">Alamat Pelatihan</label>
          <input type="text" name="alamat" id="alamat" class="w-full border border-gray-300 p-2 rounded" value="{{ old('alamat', $pelatihan->alamat) }}" required>
        </div>
        <div class="mb-3">
          <label for="deskripsi" class="block text-gray-700">Deskripsi Pelatihan</label>
          <textarea name="deskripsi" id="deskripsi" rows="3" class="w-full border border-gray-300 p-2 rounded" required>{{ old('deskripsi', $pelatihan->deskripsi) }}</textarea>
        </div>
        <!-- Checkbox untuk memilih posisi -->
        <div class="mb-3">
          <label class="block text-gray-700">Pilih Posisi yang Bisa Mengakses Pelatihan:</label>
          <div class="mt-2">
            @foreach($posisi as $position)
              <div class="flex items-center">
                <input type="checkbox" name="posisi_ids[]" value="{{ $position->id }}" id="posisi{{ $position->id }}" class="mr-2" 
                {{ in_array($position->id, $selectedPosisi) ? 'checked' : '' }}>
                <label for="posisi{{ $position->id }}" class="text-gray-700">{{ $position->nama_posisi }}</label>
              </div>
            @endforeach
          </div>
        </div>
        <div class="flex justify-end">
          <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update Pelatihan</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
