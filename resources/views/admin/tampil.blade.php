<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Tampil Data Karyawan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold text-center text-blue-600 mb-6">Data Karyawan Samudra Biru</h1>

        @if (session('success'))
    <div class="bg-green-500 text-white px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif


        <div class="mb-4 flex justify-between items-center">
            
            <a href="{{ route('admin.tambah') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Tambah Data
            </a>
        
           <form action="{{ route('logout') }}" method="POST" class="inline-block">
        @csrf
        <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
            Logout
        </button>
    </form>
    
        </div>
        <div class="overflow-x-auto">
            <table class="w-full table-auto border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="border border-gray-300 px-4 py-2">No</th>
                        <th class="border border-gray-300 px-4 py-2">Nama Karyawan</th>
                        <th class="border border-gray-300 px-4 py-2">Email</th>
                        <th class="border border-gray-300 px-4 py-2">Password</th>
                        <th class="border border-gray-300 px-4 py-2">Role</th>
                        <th class="border border-gray-300 px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($karyawan as $no => $data)
                    <tr class="bg-white hover:bg-gray-100 text-center">
                        <td class="border border-gray-300 px-4 py-2">{{ $no + 1 }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $data->nama }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $data->email }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $data->password }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $data->role }}</td>
                       
                        <td class="border border-gray-300 px-4 py-2">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('admin.edit', $data->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                    Edit
                                </a>
                                
                                <form action="{{ route('admin.delete', $data->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
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
