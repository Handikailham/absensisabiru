<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajukan Izin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Ajukan Izin</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('absen.izin') }}" method="POST">
        @csrf
        <input type="hidden" name="karyawan_id" value="{{ auth()->id() }}">

        <div class="mb-3">
            <label for="izin_mulai" class="form-label">Tanggal Mulai</label>
            <input type="date" class="form-control" name="izin_mulai" required>
        </div>

        <div class="mb-3">
            <label for="izin_selesai" class="form-label">Tanggal Selesai</label>
            <input type="date" class="form-control" name="izin_selesai" required>
        </div>

        <div class="mb-3">
            <label for="alasan" class="form-label">Alasan</label>
            <textarea class="form-control" name="alasan" rows="3" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Ajukan Izin</button>
        <a href="{{ route('absen.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
