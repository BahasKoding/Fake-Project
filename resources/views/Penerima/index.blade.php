@extends('layout.main')
@section('content')
<style>
    .main-content {
        margin-top: 0rem; /* Top margin */
        margin-bottom: 10rem; /* Bottom margin */
        margin-left: 0; /* No left margin */
        margin-right: 0; /* No right margin */
    }
    .search-box {
        display: flex;
        align-items: end;
    }
    .search-box input[type="text"] {
        flex: 1;
    }
    .search-box button {
        background: none;
        border: none;
    }
    .search-box button i {
        color: #007bff;
    }
</style>

{{-- Menampilkan pesan sukses --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="table-responsive mt-3">
    @if (Auth::user()->role == 'Warga')
        <div class="d-flex justify-content-end">
            <div class="search-box col-3">
                <input type="text" class="form-control" placeholder="Cari Nama">
                <button type="button">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>
    @endif
    <form action="{{ route('penerima.bulkUpdate') }}" method="POST">
        @csrf
        <table class="table table-striped table-sm mt-3">
            <thead>
            <tr class="text-center">
                @if (Auth::user()->role == 'Unit-Kerja')
                    <th><input type="checkbox" id="select-all"></th>
                @endif
                <th scope="col">No Penerima</th>
                <th scope="col">NIK</th>
                <th scope="col">Nama Lengkap</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Umur</th>
                <th scope="col">Alamat Rumah</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($pendataan as $p)
                    <tr class="text-center">
                        @if (Auth::user()->role == 'Unit-Kerja')
                            <td><input type="checkbox" name="ids[]" value="{{ $p->id }}"></td>
                        @endif
                        <td scope="col">{{ $p->formatPenerimaan() }}</td>
                        <td>{{ $p->nik }}</td>
                        <td>{{ $p->nama_lengkap }}</td>
                        <td>{{ $p->jenis_kelamin }}</td>
                        <td>{{ $p->umur }}</td>
                        <td>{{ $p->alamat }}</td>
                        <td>
                            @if($p->status == 0)
                                -
                            @elseif($p->status == 1)
                                Diterima
                            @elseif($p->status == 2)
                                Ditolak
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if (Auth::user()->role == 'Unit-Kerja')
            <div class="row mb-5 mt-5">
                <div class="col-2 text-end"><button type="submit" name="action" value="tolak" class="btn btn-secondary">Tolak</button></div>
                <div class="col-2 text-start">
                    <button type="submit" name="action" value="terima" class="btn btn-danger">Terima</button>
                </div>
            </div>
        @elseif(Auth::user()->role == 'Warga')
            <div class="col text-end">
                <a class="btn btn-danger" href="/dashboard">Kembali</a>
            </div>
        @endif
    </form>
</div>

<div class="main-content">

</div>


<script>
    document.getElementById('select-all').addEventListener('click', function() {
        var checkboxes = document.querySelectorAll('input[name="ids[]"]');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });
</script>
@endsection
