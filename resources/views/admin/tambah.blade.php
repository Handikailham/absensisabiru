<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Data Karyawan</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-12 px-6">

    <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Form Input Data Karyawan</h2>

    <div  class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-lg space-y-8">

        <form action="{{ route('admin.submit') }}" method="POST">
            @csrf


            <!-- Input Nama Proyek -->
            <div class="space-y-2">
                <label for="" class="block text-sm font-medium text-gray-700">Nama Karyawan</label>
                <input type="text" id="" name="nama" required 
                       class="w-full py-2 px-4 bg-gray-100 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <!-- Input Harga -->
            <div class="space-y-2">
                <label for="harga" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="harga" name="email" required 
                       class="w-full py-2 px-4 bg-gray-100 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div class="space-y-2">
                <label for="p" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="text" id="project-name" name="password"  required 
                       class="w-full py-2 px-4 bg-gray-100 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <!-- Select Status -->
            <div class="space-y-2">
                <label for="status" class="block text-sm font-medium text-gray-700">Role</label>
                <select id="status" name="role" required 
                        class="w-full py-2 px-4 bg-gray-100 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="admin">Admin</option>
                    <option value="karyawan">Karyawan</option>
                </select>
            </div>

           
            
            <div class="flex justify-between items-center space-x-4">
                <a href="{{ route('admin.tampil') }}" class="w-1/2 bg-gray-500 text-white py-2 px-6 rounded-lg text-center hover:bg-gray-600">
                    Kembali
                </a>
                <button type="submit" class="w-1/2 bg-blue-500 text-white py-2 px-6 rounded-lg text-center hover:bg-blue-600">
                    Tambah
                </button>
            </div>
        </form>

    </div>

</body>
</html>
