@extends('layouts.app')

@section('title', 'Nasabah')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Nasabah</h3>
            <h6 class="op-7 mb-2">Anda dapat mengelola semua nasabah, seperti mengedit, menghapus, dan lainnya.</h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <div class="section-header-button">
                <a href="{{ route('admin.nasabah.create') }}" class="btn btn-primary btn-round">Tambah Nasabah Baru</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="float-right">
                        <form method="GET" action="{{ route('admin.nasabah.index') }}">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Cari Nama" name="nama_nasabah"
                                    value="{{ request('nama_nasabah') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card">

                <div class="card-body">

                    <div class="clearfix mb-3"></div>

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-head-bg-primary">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>No. Registrasi</th>
                                    <th>No. HP</th>
                                    <th>Saldo</th>
                                    <th>Status</th>
                                    <th style="width: 250px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($nasabahs as $index => $nasabah)
                                    <tr>
                                        <td>{{ $nasabahs->firstItem() + $index }}</td>
                                        <td>{{ $nasabah->nama_lengkap }}</td>
                                        <td>{{ $nasabah->no_registrasi }}</td>
                                        <td>{{ $nasabah->no_hp }}</td>
                                        <td>Rp{{ number_format($nasabah->saldo->saldo, 0, ',', '.') }}</td>
                                        <td>
                                            @if ($nasabah->status === 'aktif')
                                                <span class="badge bg-success text-white">Aktif</span>
                                            @else
                                                <span class="badge bg-danger text-white">Tidak Aktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-start">
                                                <a href="{{ route('admin.nasabah.show', $nasabah->id) }}"
                                                    class="btn btn-sm btn-info me-2">
                                                    <i class="fas fa-info-circle"></i> Detail
                                                </a>
                                                <a href="{{ route('admin.nasabah.edit', $nasabah->id) }}"
                                                    class="btn btn-sm btn-primary me-2">
                                                    <i class="fas fa-pencil-alt"></i> Edit
                                                </a>
                                                {{-- <form onsubmit="return confirm('Apakah Anda yakin?');"
                                                    action="{{ route('admin.nasabah.destroy', $nasabah->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form> --}}
                                            </div>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">
                                            <div class="text-center">
                                                Belum ada nasabah.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                    <div class="float-right">
                        {{ $nasabahs->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
