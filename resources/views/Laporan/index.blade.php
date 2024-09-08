@extends('layout.main')
@section('content')

<style>
    .main-content {
        margin-top: 0rem; /* Top margin */
        margin-bottom: 10rem; /* Bottom margin */
        margin-left: 0; /* No left margin */
        margin-right: 0; /* No right margin */
    }
</style>

<div class="container mt-3">
    <div class="row">
        <div class="col"></div>
        <div class="col-3 fs-6 text-end">From Date</div>
        <div class="col-3">
            <input class="form-control" type="date" id="from_date">
        </div>
        <div class="col-1 fs-6 text-end">To Date</div>
        <div class="col-3">
            <input class="form-control" type="date" id="to_date">
        </div>
        <div class="col-1">
            <button class="btn btn-primary" onclick="filterData()">Filter</button>
        </div>
    </div>
</div>

<div class="table-responsive mt-3">
    <table class="table table-striped table-sm">
        <thead>
        <tr class="text-center">
            <th scope="col">ID Laporan</th>
            <th scope="col">Tanggal Laporan</th>
            <th scope="col">ID Monitoring</th>
            <th scope="col">Jumlah Bantuan</th>
            <th scope="col">Status Bantuan</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($pendataan as $p)
                @php
                    $monitoring = $p->monitoring->first();
                @endphp
                <tr class="text-center">
                    <td>
                        {{ $monitoring->formatLaporan() }}
                    </td>
                    <td>
                        @if($monitoring && $monitoring->created_at)
                            {{ $monitoring->created_at->format('d/m/Y') }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        {{ $p->formatMonitoring() }}
                    </td>
                    <td>
                        @if($monitoring && $monitoring->Jumlah_bantuan !== null)
                            Rp {{ number_format($monitoring->Jumlah_bantuan, 0, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if($p->status == 1)
                            diterima
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="row mb-5 mt-2">
    @if(Auth::user()->role == 'UPT')
    <div class="d-none">
        <div class="col"></div>
        <div class="col-1"><button class="btn btn-secondary">Edit</button></div>
        <div class="col-1"><button class="btn btn-secondary">Simpan</button></div>
        <div class="col-2 text-start"><button class="btn btn-danger">Kirim</button></div>
    </div>
    @elseif(Auth::user()->role == 'Mentri-Sosial')
        <div class="col"></div>
        <div class="col-2">
            <button class="btn btn-secondary" onclick="downloadPdf()">Download PDF</button>
        </div>
        <div class="col-1 text-start"><button class="btn btn-danger">Kembali</button></div>
    @endif
</div>
<div class="main-content"></div>
<script>
    function filterData() {
        const fromDate = document.getElementById('from_date').value;
        const toDate = document.getElementById('to_date').value;

        const rows = document.querySelectorAll('.table tbody tr');

        rows.forEach(row => {
            const dateCell = row.cells[1].innerText;
            const rowDate = new Date(dateCell.split('/').reverse().join('/'));

            if (dateCell !== '-' && fromDate && toDate) {
                const from = new Date(fromDate);
                const to = new Date(toDate);

                if (rowDate >= from && rowDate <= to) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            } else {
                row.style.display = '';
            }
        });
    }

    function downloadPdf() {
        const fromDate = document.getElementById('from_date').value;
        const toDate = document.getElementById('to_date').value;

        let url = '/download-pdf';
        if (fromDate && toDate) {
            url += `?from_date=${encodeURIComponent(fromDate)}&to_date=${encodeURIComponent(toDate)}`;
        }

        window.location.href = url;
    }
</script>

@endsection
