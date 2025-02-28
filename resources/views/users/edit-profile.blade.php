<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profil</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-gray-100 py-10">
  <div class="max-w-lg mx-auto bg-white p-6 rounded-md shadow-md">
    <h2 class="text-3xl font-bold text-center text-blue-500 mb-6">Edit Profil</h2>

    @if(session('success'))
      <div class="mb-4 p-3 bg-green-100 text-green-600 rounded">
        {{ session('success') }}
      </div>
    @endif

    @if($errors->any())
      <div class="mb-4 p-3 bg-red-100 text-red-600 rounded">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('karyawan.update.profile') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
      @csrf
      <div>
        <label class="block text-sm font-medium text-gray-700" for="nama">Nama</label>
        <input type="text" id="nama" name="nama" value="{{ old('nama', $karyawan->nama) }}"
               class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700" for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email', $karyawan->email) }}"
               class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
      </div>
      <!-- Field Password Baru -->
      <div>
        <label class="block text-sm font-medium text-gray-700" for="password">Password Baru</label>
        <input type="password" id="password" name="password"
               class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah password.</p>
      </div>
      <!-- Field Konfirmasi Password -->
      <div>
        <label class="block text-sm font-medium text-gray-700" for="password_confirmation">Konfirmasi Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation"
               class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>
      <!-- Field Foto Profil -->
      <div>
        <label class="block text-sm font-medium text-gray-700" for="profile_image">Foto Profil</label>
        @if($karyawan->profile_image)
          <div class="mb-2">
            <img src="{{ asset('storage/profile/' . $karyawan->profile_image) }}" alt="Foto Profil" class="h-20 w-20 rounded-full object-cover">
          </div>
        @endif
        <input type="file" id="profile_image" name="profile_image"
               class="mt-1 block w-full text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah foto.</p>
      </div>
      <!-- Tombol Aksi: Kembali dan Update Profil -->
      <div class="flex justify-between">
        <a href="{{ route('absen.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-200">
          Kembali
        </a>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-200">
          Update Profil
        </button>
      </div>
    </form>
  </div>
</body>
</html>
