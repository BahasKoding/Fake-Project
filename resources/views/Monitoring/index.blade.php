@extends('layouts.admin')

@section('title', 'Monitoring')

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
        <h1 class="h3 mb-0 text-gray-800">Monitoring</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Monitoring</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No Penerima</th>
                                    <th>NIK</th>
                                    <th>Nama Lengkap</th>
                                    <th>Jumlah Bantuan</th>
                                    <th>Status Bantuan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pendataan as $p)
                                    @php
                                        $monitoring = $p->monitoring->first();
                                    @endphp
                                    <tr>
                                        <td>{{ $p->formatPenerimaan() }}</td>
                                        <td>{{ $p->nik }}</td>
                                        <td>{{ $p->nama_lengkap }}</td>
                                        <td>{{ $monitoring ? 'Rp ' . number_format($monitoring->Jumlah_bantuan, 0, ',', '.') : '-' }}</td>
                                        <td>
                                            @if($monitoring)
                                                <span class="badge badge-success">Sudah Diberikan</span>
                                            @else
                                                <span class="badge badge-warning">Belum Diberikan</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(!$monitoring)
                                                <button class="btn btn-sm btn-primary add-btn" data-id="{{ $p->id }}">Tambah</button>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="monitoringModal" tabindex="-1" role="dialog" aria-labelledby="monitoringModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="monitoringModalLabel">Tambah Monitoring</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="monitoringForm">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" id="pendataanId" name="id_pendataan">
                        <div class="form-group">
                            <label for="jumlahBantuan">Jumlah Bantuan</label>
                            <input type="text" class="form-control" id="jumlahBantuan" name="Jumlah_bantuan" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="submitBtn">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var table = $('#dataTable').DataTable();

            // Format input jumlah bantuan
            $('#jumlahBantuan').on('input', function() {
                let value = $(this).val().replace(/\D/g, '');
                if (value.length > 3) {
                    value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                }
                $(this).val(value);
            });

            // Submit form
            $('#monitoringForm').submit(function(e) {
                e.preventDefault();

                // Remove non-digit characters before submitting
                var jumlahBantuan = $('#jumlahBantuan').val().replace(/\D/g, '');
                $('#jumlahBantuan').val(jumlahBantuan);

                var formData = $(this).serialize();
                var url = "{{ route('Monitoring.store') }}";

                $.ajax({
                    url: url,
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        $('#monitoringModal').modal('hide');
                        Swal.fire('Sukses', response.message, 'success').then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        Swal.fire('Error', 'Terjadi kesalahan', 'error');
                        console.log(xhr.responseText);
                    }
                });
            });

            // Add button click
            $(document).on('click', '.add-btn', function() {
                $('#pendataanId').val($(this).data('id'));
                $('#jumlahBantuan').val('');
                $('#monitoringModal').modal('show');
            });
        });
    </script>
@endsection
