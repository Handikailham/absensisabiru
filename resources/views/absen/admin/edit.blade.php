<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Absensi</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-gray-100 py-10">
  <h2 class="text-3xl font-bold text-center text-blue-500 mb-6">Edit Absensi</h2>
  
  <div class="max-w-lg mx-auto bg-white p-6 rounded-md shadow-md">
    <form action="{{ route('absen.admin.update', $absen->id) }}" method="POST" class="space-y-4">
      @csrf
      @method('PUT')
      
      <!-- Karyawan -->
      <div>
        <label for="karyawan_id" class="block text-sm font-medium text-gray-700">Karyawan</label>
        <select name="karyawan_id" id="karyawan_id" required 
                class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
          @foreach ($karyawans as $karyawan)
            <option value="{{ $karyawan->id }}" {{ $absen->karyawan_id == $karyawan->id ? 'selected' : '' }}>
              {{ $karyawan->nama }}
            </option>
          @endforeach
        </select>
      </div>
      
      <!-- Tanggal -->
      <div>
        <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
        <input type="date" name="tanggal" id="tanggal" value="{{ $absen->tanggal }}" required
               class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>
      
      <!-- Jam Masuk -->
      <div>
        <label for="jam_masuk" class="block text-sm font-medium text-gray-700">Jam Masuk</label>
        <input type="time" name="jam_masuk" id="jam_masuk" value="{{ $absen->jam_masuk }}"
               class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>
      
      <!-- Jam Pulang -->
      <div>
        <label for="jam_pulang" class="block text-sm font-medium text-gray-700">Jam Pulang</label>
        <input type="time" name="jam_pulang" id="jam_pulang" value="{{ $absen->jam_pulang }}"
               class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>
      
      <!-- Status -->
      <div>
        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
        <select name="status" id="status" required 
                class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option value="hadir" {{ $absen->status == 'hadir' ? 'selected' : '' }}>Hadir</option>
          <option value="terlambat" {{ $absen->status == 'terlambat' ? 'selected' : '' }}>Terlambat</option>
          <option value="izin" {{ $absen->status == 'izin' ? 'selected' : '' }}>Izin</option>
        </select>
      </div>
      
      <!-- Alasan -->
      <div>
        <label for="alasan" class="block text-sm font-medium text-gray-700">Alasan</label>
        <input type="text" name="alasan" id="alasan" value="{{ $absen->alasan }}"
               class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>
      
      <!-- Tombol -->
      <div class="flex justify-between">
        <a href="{{ route('absen.admin.index') }}" class="inline-block bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">
          Kembali
        </a>
        <button type="submit" class="inline-block bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">
          Update
        </button>
      </div>
    </form>
  </div>
</body>
</html>
