<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Bantuan Sosial</title>
    <style>
        @font-face {
            font-family: 'Roboto';
            src: url({{ storage_path('fonts/Roboto-Regular.ttf') }}) format("truetype");
            font-weight: normal;
            font-style: normal;
        }
        @font-face {
            font-family: 'Roboto';
            src: url({{ storage_path('fonts/Roboto-Bold.ttf') }}) format("truetype");
            font-weight: bold;
            font-style: normal;
        }
        body {
            font-family: 'Roboto', sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        h1 {
            color: #4e73df;
            font-size: 24px;
            margin-bottom: 10px;
        }
        .date-range {
            font-style: italic;
            color: #666;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 12px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e3e6f0;
        }
        th {
            background-color: #4e73df;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
        }
        tr:nth-child(even) {
            background-color: #f8f9fc;
        }
        .footer {
            text-align: center;
            font-size: 10px;
            color: #666;
            margin-top: 30px;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Bantuan Sosial</h1>
        @if($fromDate && $toDate)
            <p class="date-range">Periode: {{ \Carbon\Carbon::parse($fromDate)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($toDate)->format('d/m/Y') }}</p>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>ID Laporan</th>
                <th>Tanggal Laporan</th>
                <th>ID Monitoring</th>
                <th>Jumlah Bantuan</th>
                <th>Status Bantuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pendataan as $p)
                @php
                    $monitoring = $p->monitoring->first();
                @endphp
                <tr>
                    <td>{{ $monitoring ? $monitoring->formatLaporan() : '-' }}</td>
                    <td>{{ $monitoring && $monitoring->created_at ? $monitoring->created_at->format('d/m/Y') : '-' }}</td>
                    <td>{{ $p->formatMonitoring() }}</td>
                    <td>{{ $monitoring && $monitoring->Jumlah_bantuan !== null ? 'Rp ' . number_format($monitoring->Jumlah_bantuan, 0, ',', '.') : '-' }}</td>
                    <td>{{ $p->status == 1 ? 'Diterima' : '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Laporan ini digenerate pada {{ now()->format('d/m/Y H:i:s') }}</p>
    </div>
</body>
</html>
