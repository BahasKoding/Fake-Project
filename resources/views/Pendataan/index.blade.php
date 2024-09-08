@extends('layout.main')
@section('content')
    <style>
        .main-content {
            margin-top: 0rem; /* Top margin */
            margin-bottom: 13rem; /* Bottom margin */
            margin-left: 0; /* No left margin */
            margin-right: 0; /* No right margin */
        }
    </style>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form action="{{ route('pendataan.store') }}" method="POST">
        @csrf
        <div class="row mb-3 mt-5">
            <div class="col-md-6 form-group">
                <label for="noPendataan" class="form-label">No Pendataan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="no_pendataan" id="noPendataan" required>
            </div>
            <div class="col-md-6 form-group">
                <label for="jenisKelamin" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                <select class="form-control" name="jenis_kelamin" id="jenisKelamin" required>
                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6 form-group">
                <label for="nik" class="form-label">NIK <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="nik" id="nik" required>
            </div>
            <div class="col-md-6 form-group">
                <label for="umur" class="form-label">Umur <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="umur" id="umur" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6 form-group">
                <label for="namaLengkap" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="nama_lengkap" id="namaLengkap" required>
            </div>
            <div class="col-md-6 form-group">
                <label for="alamatRumah" class="form-label">Alamat Rumah <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="alamat" id="alamatRumah" required>
            </div>
        </div>
        <div class="d-flex justify-content-end mb-5">
            <button type="button" class="btn btn-outline-dark me-2">Edit</button>
            <button type="submit" class="btn btn-primary">Kirim</button>
        </div>
    </form>

    <script>
        // Fungsi untuk menghilangkan pesan alert setelah 5 detik
        setTimeout(function() {
            var alertElements = document.querySelectorAll('.alert');
            alertElements.forEach(function(alert) {
                alert.classList.remove('show');
                alert.classList.add('fade');
                setTimeout(function() {
                    alert.style.display = 'none';
                }, 500); // Mengatur waktu untuk animasi fade out
            });
        }, 5000);
    </script>




@endsection
