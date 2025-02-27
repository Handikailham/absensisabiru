<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profil</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
  <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Edit Profil</h1>

    @if(session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
      </div>
    @endif

    @if($errors->any())
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        @foreach($errors->all() as $error)
          <p>{{ $error }}</p>
        @endforeach
      </div>
    @endif

    <form action="{{ route('karyawan.update.profile') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700" for="nama">Nama</label>
        <input type="text" id="nama" name="nama" value="{{ old('nama', $karyawan->nama) }}"
               class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
      </div>
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700" for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email', $karyawan->email) }}"
               class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
      </div>
      <!-- Field Password Baru -->
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700" for="password">Password Baru</label>
        <input type="password" id="password" name="password"
               class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah password.</p>
      </div>
      <!-- Field Konfirmasi Password -->
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700" for="password_confirmation">Konfirmasi Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation"
               class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>
      <div class="mb-4">
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
      <div class="flex justify-end">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
          Update Profil
        </button>
      </div>
    </form>
  </div>
</body>
</html>
