<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Input Data Karyawan</title>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-gray-100 py-10">
  <h2 class="text-3xl font-bold text-center text-blue-500 mb-6">Form Input Data Karyawan</h2>
  
  <div class="max-w-lg mx-auto bg-white p-6 rounded-md shadow-md">
    <!-- Pesan Error -->
    @if($errors->any())
      <div class="mb-4 p-3 bg-red-100 text-red-600 rounded">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    
    <form action="{{ route('admin.submit') }}" method="POST" class="space-y-4">
      @csrf
      
      <!-- Nama Karyawan -->
      <div>
        <label for="nama" class="block text-sm font-medium text-gray-700">Nama Karyawan</label>
        <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required 
               class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>
      
      <!-- Posisi -->
      <div>
        <label for="id_posisi" class="block text-sm font-medium text-gray-700">Posisi</label>
        <select id="id_posisi" name="id_posisi" 
                class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option value="">Pilih Posisi</option>
          @foreach ($posisi as $p)
            <option value="{{ $p->id }}" {{ old('id_posisi') == $p->id ? 'selected' : '' }}>{{ $p->nama_posisi }}</option>
          @endforeach
        </select>
      </div>
      
      <!-- Email -->
      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required 
               class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>
      
      <!-- Password dengan fitur show/hide -->
      <div x-data="{ show: false }">
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <div class="mt-1 relative">
          <input :type="show ? 'text' : 'password'" id="password" name="password" required 
                 class="block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
          <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-600">
            <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" 
                 viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" 
                 viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a10.05 10.05 0 012.249-3.523M9.88 9.88a3 3 0 104.243 4.243" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    d="M3 3l18 18" />
            </svg>
          </button>
        </div>
      </div>
      
      <!-- Tipe Karyawan -->
      <div>
        <label for="tipe_karyawan" class="block text-sm font-medium text-gray-700">Tipe Karyawan</label>
        <select id="tipe_karyawan" name="tipe_karyawan" required 
                class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option value="tetap" {{ old('tipe_karyawan', 'tetap') == 'tetap' ? 'selected' : '' }}>Karyawan Tetap</option>
          <option value="kontrak" {{ old('tipe_karyawan') == 'kontrak' ? 'selected' : '' }}>Karyawan Kontrak</option>
          <option value="magang" {{ old('tipe_karyawan') == 'magang' ? 'selected' : '' }}>Magang</option>
        </select>
      </div>
      
      <!-- Role -->
      <div>
        <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
        <select id="role" name="role" required 
                class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
          <option value="karyawan" {{ old('role') == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
        </select>
      </div>
      
      <!-- Tombol -->
      <div class="flex justify-between">
        <a href="{{ route('admin.tampil') }}" class="inline-block bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">
          Kembali
        </a>
        <button type="submit" class="inline-block bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">
          Tambah
        </button>
      </div>
    </form>
  </div>
</body>
</html
