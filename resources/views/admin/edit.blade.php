<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Karyawan</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-12 px-6">

    <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Edit Data Karyawan</h2>

    <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-lg space-y-8">

        <!-- Tampilkan pesan error jika ada -->
        @if($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-600 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.update', $karyawan->id) }}" method="POST">
            @csrf
            @method('PUT') 

            <!-- Nama Karyawan -->
            <div class="space-y-2">
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Karyawan</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama', $karyawan->nama) }}" required
                       class="w-full py-2 px-4 bg-gray-100 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <!-- Posisi -->
            <div class="space-y-2">
                <label for="id_posisi" class="block text-sm font-medium text-gray-700">Posisi</label>
                <select id="id_posisi" name="id_posisi"
                        class="w-full py-2 px-4 bg-gray-100 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Pilih Posisi</option>
                    @foreach ($posisi as $p)
                        <option value="{{ $p->id }}" {{ old('id_posisi', $karyawan->id_posisi) == $p->id ? 'selected' : '' }}>
                            {{ $p->nama_posisi }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <!-- Email -->
            <div class="space-y-2">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $karyawan->email) }}" required
                       class="w-full py-2 px-4 bg-gray-100 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <!-- Password -->
            <div class="space-y-2">
                <label for="password" class="block text-sm font-medium text-gray-700">Password (Kosongkan jika tidak diubah)</label>
                <input type="password" id="password" name="password"
                       class="w-full py-2 px-4 bg-gray-100 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            
            <!-- Tipe Karyawan -->
            <div class="space-y-2">
                <label for="tipe_karyawan" class="block text-sm font-medium text-gray-700">Tipe Karyawan</label>
                <select id="tipe_karyawan" name="tipe_karyawan" required
                        class="w-full py-2 px-4 bg-gray-100 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="tetap" {{ old('tipe_karyawan', $karyawan->tipe_karyawan) == 'tetap' ? 'selected' : '' }}>Karyawan Tetap</option>
                    <option value="kontrak" {{ old('tipe_karyawan', $karyawan->tipe_karyawan) == 'kontrak' ? 'selected' : '' }}>Karyawan Kontrak</option>
                    <option value="magang" {{ old('tipe_karyawan', $karyawan->tipe_karyawan) == 'magang' ? 'selected' : '' }}>Magang</option>
                </select>
            </div>
            
            <!-- Role -->
            <div class="space-y-2">
                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                <select id="role" name="role" required
                        class="w-full py-2 px-4 bg-gray-100 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="admin" {{ old('role', $karyawan->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="karyawan" {{ old('role', $karyawan->role) == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
                </select>
            </div>

            
            <div class="flex justify-between items-center space-x-4">
                <a href="{{ route('admin.tampil') }}" class="w-1/2 bg-gray-500 text-white py-2 px-6 rounded-lg text-center hover:bg-gray-600">
                    Kembali
                </a>
                <button type="submit" class="w-1/2 bg-blue-500 text-white py-2 px-6 rounded-lg text-center hover:bg-blue-600">
                    Update
                </button>
            </div>
        </form>

    </div>

</body>
</html>
