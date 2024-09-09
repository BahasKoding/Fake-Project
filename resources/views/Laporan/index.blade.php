@extends('layouts.admin')

@section('title', 'Laporan')

@section('styles')
<style>
    .btn-primary:hover {
        background-color: #4e73df !important;
        border-color: #4e73df !important;
    }
</style>
@endsection

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Laporan</h1>
    </div>

    <!-- Filter Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter Laporan</h6>
        </div>
        <div class="card-body">
            <form id="filterForm" action="{{ route('Laporan.index') }}" method="GET">
                <div class="row align-items-end">
                    <div class="col-md-3 mb-3">
                        <label for="from_date" class="form-label">Dari Tanggal</label>
                        <input class="form-control" type="date" id="from_date" name="from_date" value="{{ request('from_date') }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="to_date" class="form-label">Sampai Tanggal</label>
                        <input class="form-control" type="date" id="to_date" name="to_date" value="{{ request('to_date') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-2">
                                <i class="fas fa-filter"></i> Filter
                            </button>
                            <a href="{{ route('Laporan.index') }}" class="btn btn-secondary me-2">
                                <i class="fas fa-sync-alt"></i> Reset
                            </a>
                            @if(Auth::user()->role == 'Mentri-Sosial')
                                <button type="button" class="btn btn-info me-2" onclick="downloadPdf()">
                                    <i class="fas fa-file-pdf"></i> Download PDF
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Laporan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });

        function downloadPdf() {
            const fromDate = document.getElementById('from_date').value;
            const toDate = document.getElementById('to_date').value;

            let url = '{{ route("laporan.downloadPdf") }}';
            const params = new URLSearchParams();

            if (fromDate) params.append('from_date', fromDate);
            if (toDate) params.append('to_date', toDate);

            if (params.toString()) {
                url += '?' + params.toString();
            }

            window.location.href = url;
        }
    </script>
@endsection
