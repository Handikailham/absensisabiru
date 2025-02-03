<!DOCTYPE html>
<html>
<head>
    <title>Keterangan Izin</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 80%; margin: 0 auto; }
        .title { text-align: center; font-size: 20px; font-weight: bold; }
        .content { margin-top: 20px; }
        .signature { margin-top: 50px; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="title">Surat Izin</div>
        <div class="content">
            <p><strong>Nama Karyawan:</strong> {{ $izins->first()->karyawan->nama }}</p>
            <!-- Tampilkan rentang tanggal -->
            <p><strong>Tanggal Izin:</strong> {{ $izins->first()->tanggal }} - {{ $izins->last()->tanggal }}</p>
            <p><strong>Alasan:</strong> {{ $izins->first()->alasan }}</p>
        </div>
        <div class="signature">
            <p><strong>Tanda Tangan Karyawan:</strong></p>
            <p>...........................................</p>
            <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>
        </div>
    </div>
</body>
</html>
