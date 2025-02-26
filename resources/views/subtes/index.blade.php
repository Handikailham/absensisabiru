<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Subtes</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-gray-50 p-6">
  <div class="max-w-7xl mx-auto bg-white p-6 rounded-md shadow-md">
    <h1 class="text-3xl font-bold text-blue-600 mb-6">Daftar Subtes</h1>
    <div class="mb-4">
      <a href="{{ route('subtes.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Tambah Subtes
      </a>
    </div>
    <table class="w-full table-auto border-collapse border border-gray-300">
      <thead>
        <tr class="bg-gray-200">
          <th class="border border-gray-300 px-4 py-2">No</th>
          <th class="border border-gray-300 px-4 py-2">Nama Subtes</th>
          <th class="border border-gray-300 px-4 py-2">Durasi (menit)</th>
          <th class="border border-gray-300 px-4 py-2">Urutan</th>
          <th class="border border-gray-300 px-4 py-2">Pelatihan</th>
          <th class="border border-gray-300 px-4 py-2">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($subtes as $index => $st)
        <tr class="hover:bg-gray-100 text-center">
          <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
          <td class="border border-gray-300 px-4 py-2">{{ $st->nama_subtes }}</td>
          <td class="border border-gray-300 px-4 py-2">{{ $st->durasi }}</td>
          <td class="border border-gray-300 px-4 py-2">{{ $st->urutan }}</td>
          <td class="border border-gray-300 px-4 py-2">{{ optional($st->pelatihan)->nama_pelatihan ?? 'N/A' }}</td>
          <td class="border border-gray-300 px-4 py-2">
            <a href="{{ route('subtes.edit', $st->id) }}" class="text-blue-600 hover:text-blue-800 mr-2">Edit</a>
            <form action="{{ route('subtes.destroy', $st->id) }}" method="POST" class="inline-block">
              @csrf
              @method('DELETE')
              <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Anda yakin ingin menghapus subtes ini?')">Hapus</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</body>
</html>
