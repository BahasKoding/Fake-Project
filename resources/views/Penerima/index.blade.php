@extends('layouts.admin')

@section('title', 'Penerima')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Penerima</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Penerima</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <form id="bulkUpdateForm">
                            @csrf
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        @if (Auth::user()->role == 'Unit-Kerja')
                                            <th><input type="checkbox" id="select-all"></th>
                                        @endif
                                        <th>No Penerima</th>
                                        <th>NIK</th>
                                        <th>Nama Lengkap</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Umur</th>
                                        <th>Alamat Rumah</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pendataan as $p)
                                    <tr>
                                        @if (Auth::user()->role == 'Unit-Kerja')
                                            <td>
                                                <input type="checkbox" name="ids[]" value="{{ $p->id }}" data-status="{{ $p->status }}"
                                                    {{ $p->status != 0 ? 'disabled' : '' }}>
                                            </td>
                                        @endif
                                        <td>{{ $p->formatPenerimaan() }}</td>
                                        <td>{{ $p->nik }}</td>
                                        <td>{{ $p->nama_lengkap }}</td>
                                        <td>{{ $p->jenis_kelamin }}</td>
                                        <td>{{ $p->umur }}</td>
                                        <td>{{ $p->alamat }}</td>
                                        <td>
                                            @if($p->status == 0)
                                                <label class="badge bg-warning text-white">Pending</label>
                                            @elseif($p->status == 1)
                                                <label class="badge bg-success text-white">Diterima</label>
                                            @elseif($p->status == 2)
                                                <label class="badge bg-danger text-white">Ditolak</label>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if (Auth::user()->role == 'Unit-Kerja')
                                <div class="row mb-5 mt-5">
                                    <div class="col-2 text-end">
                                        <button type="button" class="btn btn-secondary" id="tolakButton">Tolak</button>
                                    </div>
                                    <div class="col-2 text-start">
                                        <button type="button" class="btn btn-danger" id="terimaButton">Terima</button>
                                    </div>
                                </div>
                            @endif
                        </form>
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
            var table = $('#dataTable').DataTable();

            $('#select-all').click(function() {
                $('input[name="ids[]"]:not(:disabled)').prop('checked', this.checked);
            });

            function bulkUpdate(action) {
                var ids = $('input[name="ids[]"]:checked').map(function() {
                    return this.value;
                }).get();

                if (ids.length === 0) {
                    Swal.fire('Peringatan', 'Pilih setidaknya satu data', 'warning');
                    return;
                }

                var nonPendingSelected = $('input[name="ids[]"]:checked').filter(function() {
                    return $(this).data('status') != 0;
                }).length > 0;

                if (nonPendingSelected) {
                    Swal.fire('Peringatan', 'Hanya data dengan status Pending yang dapat diubah', 'warning');
                    return;
                }

                $.ajax({
                    url: "{{ route('penerima.bulkUpdate') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        ids: ids,
                        action: action
                    },
                    success: function(response) {
                        Swal.fire('Berhasil', response.message, 'success').then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        Swal.fire('Error', xhr.responseJSON?.error || 'Terjadi kesalahan', 'error');
                    }
                });
            }

            $('#tolakButton').click(function() {
                bulkUpdate('tolak');
            });

            $('#terimaButton').click(function() {
                bulkUpdate('terima');
            });

            $('input[name="ids[]"]').change(function() {
                if ($(this).data('status') != 0 && $(this).is(':checked')) {
                    $(this).prop('checked', false);
                    Swal.fire('Peringatan', 'Hanya data dengan status Pending yang dapat dipilih', 'warning');
                }
            });

            var searchTimer;
            $('#searchInput').on('input', function() {
                clearTimeout(searchTimer);
                searchTimer = setTimeout(function() {
                    performSearch();
                }, 500); // Delay 500ms sebelum melakukan pencarian
            });

            function performSearch() {
                var query = $('#searchInput').val();
                $.ajax({
                    url: "{{ route('penerima.search') }}",
                    type: 'GET',
                    data: { query: query },
                    success: function(data) {
                        table.clear();
                        data.forEach(function(item) {
                            var statusText = item.status == 0 ? '-' : (item.status == 1 ? 'Diterima' : 'Ditolak');
                            var row = [
                                item.no_penerima,
                                item.nik,
                                item.nama_lengkap,
                                item.jenis_kelamin,
                                item.umur,
                                item.alamat,
                                statusText
                            ];
                            if ("{{ Auth::user()->role }}" == 'Unit-Kerja') {
                                row.unshift('<input type="checkbox" name="ids[]" value="' + item.id + '">');
                            }
                            table.row.add(row);
                        });
                        table.draw();
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr);
                        // Optionally show an error message to the user
                    }
                });
            }
        });
    </script>
@endsection
