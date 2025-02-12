<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Data Gaji</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #333;
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #eee;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h2>Detail Data Gaji Karyawan</h2>
    <table>
        <tr>
            <th>Nama Karyawan</th>
            <td>{{ $gaji->karyawan->nama ?? '-' }}</td>
        </tr>
        <tr>
            <th>Posisi</th>
            <td>{{ $gaji->posisi->nama_posisi ?? '-' }}</td>
        </tr>
        <tr>
            <th>Gaji Pokok</th>
            <td>{{ number_format($gaji->karyawan->posisi->gaji_pokok ?? 0, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Tunjangan</th>
            <td>{{ number_format($gaji->karyawan->posisi->tunjangan ?? 0, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Lembur</th>
            <td>{{ number_format($gaji->lembur, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Bonus</th>
            <td>{{ number_format($gaji->bonus, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Total Gaji</th>
            <td>{{ number_format($gaji->total_gaji, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Tanggal Gajian</th>
            <td>{{ \Carbon\Carbon::parse($gaji->tanggal_gajian)->format('d/m/Y') }}</td>
        </tr>
    </table>
    <p style="text-align: right;">Dicetak: {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}</p>
</body>
</html>
