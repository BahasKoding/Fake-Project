@extends('layout.main')
@section('content')

<style>
    .main-content {
        margin-top: 0rem; /* Top margin */
        margin-bottom: 16rem; /* Bottom margin */
        margin-left: 0; /* No left margin */
        margin-right: 0; /* No right margin */
    }
</style>

<div class="table-responsive mt-3">
    <table class="table table-striped table-sm">
        <thead>
        <tr class="text-center">
            <th>Select</th>
            <th scope="col">ID Monitoring</th>
            <th scope="col">Tanggal Monitoring</th>
            <th scope="col">No Penerima</th>
            <th scope="col">NIK</th>
            <th scope="col">Nama Lengkap</th>
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
                    <td><input type="checkbox" name="select_id" value="{{ $p->id }}" data-bs-toggle="modal" data-bs-target="#editModal-{{ $p->id }}"></td>
                    <td>{{ $p->id ? $p->formatMonitoring() : '-' }}</td>
                    {{-- <td>{{ $monitoring->created_at ?? '-' }}</td> --}}
                    <td>
                        @if($monitoring && $monitoring->created_at)
                            {{ $monitoring->created_at->format('d/m/Y') }}
                        @else
                            -
                        @endif
                    </td>

                    <td scope="col">{{ $p->formatPenerimaan() }}</td>
                    <td>{{ $p->nik }}</td>
                    <td>{{ $p->nama_lengkap }}</td>
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

                <!-- Modal for each record -->
                <div class="modal fade" id="editModal-{{ $p->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $p->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel-{{ $p->id }}">Tambah Data Monitoring untuk ID {{ $p->id }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('monitoring.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id_pendataan" value="{{ $p->id }}">
                                    <div class="col-md-12 mb-3">
                                        <label for="Jumlah_bantuan-{{ $p->id }}" class="form-label">Jumlah Bantuan <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control jumlah_bantuan" name="Jumlah_bantuan" id="Jumlah_bantuan-{{ $p->id }}" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
</div>

<div class="row mb-5 d-none">
    <div class="col-2 text-end"><button class="btn btn-danger">Selesai</button></div>
    <div class="col-2 text-start"><button class="btn btn-secondary">Save</button></div>
</div>


<div class="main-content">

</div>

<!-- Tambahkan script untuk memformat input jumlah bantuan -->
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        document.querySelectorAll('.jumlah_bantuan').forEach(function(input) {
            input.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, ''); // Hapus karakter non-digit
                if (value.length > 3) {
                    value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.'); // Tambahkan titik sebagai pemisah ribuan
                }
                e.target.value = value;
            });

            input.addEventListener('blur', function(e) {
                e.target.value = e.target.value.replace(/\D/g, ''); // Hapus titik saat input kehilangan fokus
            });
        });
    });
</script>

@endsection
