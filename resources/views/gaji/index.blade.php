<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Gaji</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.tampil') }}" class="text-gray-800 hover:text-blue-600">
                    Data Karyawan
                </a>
                <a href="{{ route('absen.admin.index') }}" class="text-gray-800 hover:text-blue-600">
                    Data Absensi
                </a>
                <a href="{{ route('gaji.index') }}" class="text-gray-800 hover:text-blue-600 font-bold text-blue-600">
                    Data Gaji
                </a>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-gray-700">{{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200">
            <div class="p-6">
                <h1 class="text-3xl font-semibold text-center text-blue-600 mb-6">Data Gaji Karyawan</h1>

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 flex items-center">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="w-full table-auto border-collapse border border-gray-300 rounded-lg overflow-hidden">
                        <thead>
                            <tr class="bg-gray-200 text-gray-700">
                                <th class="border border-gray-300 px-6 py-3">No</th>
                                <th class="border border-gray-300 px-6 py-3">Nama Karyawan</th>
                                <th class="border border-gray-300 px-6 py-3">Posisi</th>
                                <th class="border border-gray-300 px-6 py-3">Lembur</th>
                                <th class="border border-gray-300 px-6 py-3">Bonus</th>
                                <th class="border border-gray-300 px-6 py-3">Total Gaji</th>
                                <th class="border border-gray-300 px-6 py-3">Tanggal Gajian</th>
                                <th class="border border-gray-300 px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach ($gaji as $no => $item)
                            <tr class="hover:bg-gray-100 text-center border-b">
                                <td class="px-6 py-4">{{ $no + 1 }}</td>
                                <td class="px-6 py-4">{{ optional($item->karyawan)->nama ?? 'N/A' }}</td>
                                <td class="px-6 py-4">{{ optional($item->posisi)->nama_posisi ?? 'N/A' }}</td>
                                <td class="px-6 py-4">{{ number_format($item->lembur, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">{{ number_format($item->bonus, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 font-semibold text-green-600">{{ number_format($item->total_gaji, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">{{ date('d M Y', strtotime($item->tanggal_gajian)) }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('gaji.export.one', $item->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600 shadow-md">
                                        Ekspor PDF
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>
