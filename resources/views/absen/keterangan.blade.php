<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keterangan Izin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Keterangan Izin</h2>

    <p><strong>Nama Karyawan:</strong> {{ $izins->first()->karyawan->nama }}</p>
    <p><strong>Tanggal Izin:</strong> {{ $izins->first()->tanggal }} - {{ $izins->last()->tanggal }}</p>
    <p><strong>Alasan:</strong> {{ $izins->first()->alasan }}</p>
    
    <a href="{{ route('absen.generatePDF', $izins->first()->id) }}" class="btn btn-primary">Download PDF</a>
    <a href="{{ route('absen.index') }}" class="btn btn-secondary">Kembali</a>
</div>
</body>
</html>
