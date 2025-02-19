<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keterangan Izin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-100 via-white to-blue-100 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-2xl bg-white shadow-2xl rounded-3xl overflow-hidden border border-blue-100">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-6 text-white">
            <h2 class="text-2xl font-bold">Keterangan Izin</h2>
        </div>

        <!-- Body -->
        <div class="p-6 space-y-4">
            <!-- Informasi Izin -->
            <div class="bg-blue-50 p-4 rounded-lg shadow">
                <p class="text-lg text-gray-700"><strong>Nama Karyawan:</strong> {{ $izins->first()->karyawan->nama }}</p>
                <p class="text-lg text-gray-700"><strong>Tanggal Izin:</strong> {{ $izins->first()->tanggal }} - {{ $izins->last()->tanggal }}</p>
                <p class="text-lg text-gray-700"><strong>Alasan:</strong> {{ $izins->first()->alasan }}</p>
            </div>

            <!-- Tombol -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route('absen.index') }}" class="bg-gray-500 text-white px-5 py-2 rounded-lg hover:bg-gray-600 transition">
                    Kembali
                </a>
                <a href="{{ route('absen.generatePDF', $izins->first()->id) }}" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">
                    Download PDF
                </a>
            </div>
        </div>
    </div>
</body>
</html>
