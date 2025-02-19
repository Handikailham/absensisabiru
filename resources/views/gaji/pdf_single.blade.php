<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Slip Gaji</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            width: 100%;
            max-width: 700px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            padding: 20px 0;
            border-bottom: 2px solid #555;
            margin-bottom: 20px;
        }
        .header img {
            max-height: 70px;
            margin-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 22px;
            color: #222;
        }
        .header p {
            margin: 4px 0 0;
            font-size: 14px;
            color: #555;
        }
        .details, .salary-details {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .details th, .details td, .salary-details th, .salary-details td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        .details th {
            background-color: #f8f8f8;
            text-align: left;
        }
        .salary-details th {
            background-color: #444;
            color: #fff;
            text-align: left;
        }
        .salary-details td {
            text-align: right;
        }
        .salary-details tr.total td {
            font-weight: bold;
            font-size: 14px;
            border-top: 2px solid #444;
        }
        .footer {
            text-align: right;
            font-size: 10px;
            color: #777;
            border-top: 1px solid #ddd;
            padding-top: 8px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <!-- Logo Perusahaan -->
            <img src="{{ public_path('image/sabiru.png') }}" alt="Logo Perusahaan">
            <h1>Slip Gaji Karyawan</h1>
            <p>PT. Samudra Biru Development</p>
        </div>

        <table class="details">
            <tr>
                <th>Nama Karyawan</th>
                <td>{{ $gaji->karyawan->nama ?? '-' }}</td>
            </tr>
            <tr>
                <th>Posisi</th>
                <td>{{ $gaji->posisi->nama_posisi ?? '-' }}</td>
            </tr>
            <tr>
                <th>Tipe Karyawan</th>
                <td>{{ $gaji->karyawan->tipe_karyawan ?? '-' }}</td>
            </tr>
            <tr>
                <th>Tanggal Gajian</th>
                <td>{{ \Carbon\Carbon::parse($gaji->tanggal_gajian)->format('d/m/Y') }}</td>
            </tr>
        </table>

        <table class="salary-details">
            <tr>
                <th>Keterangan</th>
                <th>Jumlah</th>
            </tr>
            <tr>
                <td>Gaji Pokok</td>
                <td>
                    @if($gaji->karyawan->tipe_karyawan == 'magang')
                        0
                    @else
                        {{ number_format(optional($gaji->posisi)->gaji_pokok, 0, ',', '.') }}
                    @endif
                </td>
            </tr>
            <tr>
                <td>Tunjangan</td>
                <td>{{ number_format(optional($gaji->posisi)->tunjangan, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Lembur</td>
                <td>{{ number_format($gaji->lembur, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Bonus</td>
                <td>{{ number_format($gaji->bonus, 0, ',', '.') }}</td>
            </tr>
            <tr class="total">
                <td>Total Gaji</td>
                <td>{{ number_format($gaji->total_gaji, 0, ',', '.') }}</td>
            </tr>
        </table>

        <div class="footer">
            Dicetak: {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}
        </div>
    </div>
</body>
</html>
