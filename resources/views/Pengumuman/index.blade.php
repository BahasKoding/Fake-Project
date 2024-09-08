@extends('layouts.admin')

@section('title', 'Pengumuman')

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
        <h1 class="h3 mb-0 text-gray-800">Pengumuman</h1>
        @if (Auth::user()->role == 'Unit-Kerja')
            <button class="d-none d-sm-inline-block btn btn-sm btn-primary" data-toggle="modal" data-target="#addModal">
                <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Pengumuman
            </button>
        @endif
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Pengumuman</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Judul Kegiatan</th>
                                    <th>File</th>
                                    @if (Auth::user()->role == 'Unit-Kerja')
                                        <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengumuman as $p)
                                <tr>
                                    <td>{{ $p->judul_kegiatan }}</td>
                                    <td>
                                        @if($p->file)
                                            <a href="{{ asset('storage/' . $p->file) }}" target="_blank">Lihat File</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    @if (Auth::user()->role == 'Unit-Kerja')
                                        <td>
                                            <button class="btn btn-sm btn-info edit-btn" data-id="{{ $p->id }}">Edit</button>
                                            <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $p->id }}">Hapus</button>
                                        </td>
                                    @endif
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
                    <h5 class="modal-title" id="addModalLabel">Tambah Pengumuman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addForm">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="judulKegiatan">Judul Kegiatan</label>
                            <input type="text" name="judul_kegiatan" class="form-control" id="judulKegiatan" required>
                        </div>
                        <div class="form-group">
                            <label for="uploadFile">File</label>
                            <input type="file" name="file" class="form-control-file" id="uploadFile" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Pengumuman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editForm">
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="editId">
                        <div class="form-group">
                            <label for="editJudulKegiatan">Judul Kegiatan</label>
                            <input type="text" name="judul_kegiatan" class="form-control" id="editJudulKegiatan" required>
                        </div>
                        <div class="form-group" id="currentFileContainer" style="display: none;">
                            <label>File Saat Ini:</label>
                            <a id="currentFileLink" href="#" target="_blank">Lihat File Saat Ini</a>
                        </div>
                        <div class="form-group">
                            <label for="editUploadFile">File Baru (Biarkan kosong jika tidak ingin mengubah)</label>
                            <input type="file" name="file" class="form-control-file" id="editUploadFile">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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

            // Add form submit
            $('#addForm').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('Pengumuman.store') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#addModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        var errorMessage = 'Terjadi kesalahan. Silakan coba lagi.';
                        if (xhr.responseJSON && xhr.responseJSON.error) {
                            errorMessage = xhr.responseJSON.error;
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: errorMessage
                        });
                    }
                });
            });

            // Edit button click
            $(document).on('click', '.edit-btn', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: "{{ url('pengumuman') }}/" + id + "/edit",
                    type: 'GET',
                    success: function(data) {
                        $('#editId').val(data.id);
                        $('#editJudulKegiatan').val(data.judul_kegiatan);
                        $('#editForm').attr('action', "{{ url('pengumuman') }}/" + id);

                        // Tambahkan ini untuk menampilkan link file saat ini
                        if (data.file) {
                            $('#currentFileLink').attr('href', "{{ asset('storage') }}/" + data.file);
                            $('#currentFileLink').text('Lihat File Saat Ini');
                            $('#currentFileContainer').show();
                        } else {
                            $('#currentFileContainer').hide();
                        }

                        $('#editModal').modal('show');
                    },
                    error: function(xhr) {
                        var errorMessage = 'Terjadi kesalahan. Silakan coba lagi.';
                        if (xhr.responseJSON && xhr.responseJSON.error) {
                            errorMessage = xhr.responseJSON.error;
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: errorMessage
                        });
                    }
                });
            });

            // Edit form submit
            $('#editForm').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                var id = $('#editId').val();
                $.ajax({
                    url: "{{ url('pengumuman') }}/" + id,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#editModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        var errorMessage = 'Terjadi kesalahan. Silakan coba lagi.';
                        if (xhr.responseJSON && xhr.responseJSON.error) {
                            errorMessage = xhr.responseJSON.error;
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: errorMessage
                        });
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
                            url: "{{ url('pengumuman') }}/" + id,
                            type: 'DELETE',
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Terhapus!',
                                    response.message,
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            },
                            error: function(xhr) {
                                var errorMessage = 'Terjadi kesalahan. Silakan coba lagi.';
                                if (xhr.responseJSON && xhr.responseJSON.error) {
                                    errorMessage = xhr.responseJSON.error;
                                }
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: errorMessage
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
