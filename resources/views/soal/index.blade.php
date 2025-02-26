<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Soal</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<!-- Panggil Sidebar -->
<body class="bg-gray-50 min-h-screen p-6">
  <div class="max-w-7xl mx-auto bg-white shadow-xl rounded-lg p-6">
    <h1 class="text-3xl font-bold text-blue-600 mb-6">Daftar Soal</h1>
    <div class="mb-4">
      <a href="{{ route('soal.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Tambah Soal
      </a>
    </div>
    <table class="min-w-full border-collapse border border-gray-300">
      <thead>
        <tr class="bg-gray-200">
          <th class="border border-gray-300 px-4 py-2">No</th>
          <th class="border border-gray-300 px-4 py-2">Pertanyaan</th>
          <th class="border border-gray-300 px-4 py-2">Sub Tes</th>
          <th class="border border-gray-300 px-4 py-2">Jawaban Benar</th>
          <th class="border border-gray-300 px-4 py-2">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($soals as $index => $soal)
          <tr class="hover:bg-gray-100">
            <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $soal->pertanyaan }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ optional($soal->subtes)->nama_subtes ?? 'N/A' }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ strtoupper($soal->jawaban_benar) }}</td>
            <td class="border border-gray-300 px-4 py-2">
              <a href="{{ route('soal.edit', $soal->id) }}" class="text-blue-600 hover:text-blue-800 mr-2">Edit</a>
              <form action="{{ route('soal.destroy', $soal->id) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Anda yakin ingin menghapus soal ini?')">Hapus</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</body>
</html>
