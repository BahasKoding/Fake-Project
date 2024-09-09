@extends('layouts.admin')

@section('title', 'Pendataan')

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
        <h1 class="h3 mb-0 text-gray-800">Pendataan</h1>
        <button class="d-none d-sm-inline-block btn btn-sm btn-primary" data-toggle="modal" data-target="#addModal">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Pendataan
        </button>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Pendataan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No Pendataan</th>
                                    <th>NIK</th>
                                    <th>Nama Lengkap</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Umur</th>
                                    <th>Alamat</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendataan as $data)
                                <tr>
                                    <td>{{ $data->no_pendataan }}</td>
                                    <td>{{ $data->nik }}</td>
                                    <td>{{ $data->nama_lengkap }}</td>
                                    <td>{{ $data->jenis_kelamin }}</td>
                                    <td>{{ $data->umur }}</td>
                                    <td>{{ $data->alamat }}</td>
                                    <td>
                                        @if($data->status == 0)
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($data->status == 1)
                                            <span class="badge badge-success">Diterima</span>
                                        @else
                                            <span class="badge badge-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-info edit-btn" data-id="{{ $data->id }}">Edit</button>
                                        <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $data->id }}">Hapus</button>
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

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Pendataan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="pendataanForm">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" id="pendataanId">
                        <div class="form-group">
                            <label for="noPendataan">No Pendataan</label>
                            <input type="text" class="form-control" id="noPendataan" name="no_pendataan" required>
                        </div>
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="number" class="form-control" id="nik" name="nik" required>
                        </div>
                        <div class="form-group">
                            <label for="namaLengkap">Nama Lengkap</label>
                            <input type="text" class="form-control" id="namaLengkap" name="nama_lengkap" required>
                        </div>
                        <div class="form-group">
                            <label for="jenisKelamin">Jenis Kelamin</label>
                            <select class="form-control" id="jenisKelamin" name="jenis_kelamin" required>
                                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="umur">Umur</label>
                            <input type="number" class="form-control" id="umur" name="umur" required>
                        </div>
                        <div class="form-group">
                            <label for="alamatRumah">Alamat Rumah</label>
                            <input type="text" class="form-control" id="alamatRumah" name="alamat" required>
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
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script>
        $(document).ready(function() {
            var table = $('#dataTable').DataTable();

            // Submit form
            $('#pendataanForm').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                var url = "{{ route('Pendataan.store') }}";
                var method = "POST";

                if ($('#pendataanId').val()) {
                    url = "/pendataan/" + $('#pendataanId').val();
                    method = "PUT";
                }

                $.ajax({
                    url: url,
                    type: method,
                    data: formData,
                    success: function(response) {
                        $('#addModal').modal('hide');
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

            // Edit button click
            $(document).on('click', '.edit-btn', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: "/pendataan/" + id + "/edit",
                    type: 'GET',
                    success: function(response) {
                        $('#pendataanId').val(response.id);
                        $('#noPendataan').val(response.no_pendataan);
                        $('#nik').val(response.nik);
                        $('#namaLengkap').val(response.nama_lengkap);
                        $('#jenisKelamin').val(response.jenis_kelamin);
                        $('#umur').val(response.umur);
                        $('#alamatRumah').val(response.alamat);
                        $('#submitBtn').text('Update');
                        $('#addModal').modal('show');
                    },
                    error: function(xhr) {
                        Swal.fire('Error', 'Terjadi kesalahan', 'error');
                    }
                });
            });

            // Delete button click
            $(document).on('click', '.delete-btn', function() {
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/pendataan/" + id,
                            type: 'DELETE',
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                Swal.fire('Terhapus!', response.message, 'success').then(() => {
                                    location.reload();
                                });
                            },
                            error: function(xhr) {
                                Swal.fire('Error', 'Terjadi kesalahan', 'error');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
