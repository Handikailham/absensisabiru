<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Karyawan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-6xl bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-3xl font-semibold text-center text-blue-600 mb-6">Data Karyawan Samudra Biru</h1>

        @if (session('success'))
            <div class="bg-green-500 text-white px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-4">
            <a href="{{ route('admin.tambah') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 shadow-md">
                Tambah Data
            </a>
            <form action="{{ route('logout') }}" method="POST" class="inline-block">
                @csrf
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 shadow-md">
                    Logout
                </button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full table-auto border-collapse border border-gray-300 rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-gradient-to-r from-blue-500 to-blue-700 text-white">
                        <th class="border border-gray-300 px-6 py-3">No</th>
                        <th class="border border-gray-300 px-6 py-3">Nama Karyawan</th>
                        <th class="border border-gray-300 px-6 py-3">Email</th>
                        <th class="border border-gray-300 px-6 py-3">Role</th>
                        <th class="border border-gray-300 px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($karyawan as $no => $data)
                    <tr class="hover:bg-gray-100 text-center border-b">
                        <td class="px-6 py-4">{{ $no + 1 }}</td>
                        <td class="px-6 py-4">{{ $data->nama }}</td>
                        <td class="px-6 py-4">{{ $data->email }}</td>
                        <td class="px-6 py-4 text-blue-600 font-semibold">{{ ucfirst($data->role) }}</td>
                        <td class="px-6 py-4">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('admin.edit', $data->id) }}" class="bg-green-500 text-white px-3 py-1 rounded-lg hover:bg-green-600 shadow-md">
                                    Edit
                                </a>
                                <form action="{{ route('admin.delete', $data->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 shadow-md">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
