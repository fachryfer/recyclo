@extends('layouts.app')

@section('title', 'Hadiah')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Hadiah</h3>
            <h6 class="op-7 mb-2">Anda dapat mengelola semua hadiah, seperti mengedit, menghapus, dan lainnya.</h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <div class="section-header-button">
                <a href="{{ route('admin.hadiah.create') }}" class="btn btn-primary btn-round">Tambah Hadiah Baru</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="clearfix mb-3"></div>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-head-bg-primary">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Hadiah</th>
                                    <th>Deskripsi</th>
                                    <th>Harga Redeem</th>
                                    <th>Stok</th>
                                    <th>Status</th>
                                    <th style="width: 250px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($hadiah as $index => $h)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $h->nama_hadiah }}</td>
                                        <td>{{ $h->deskripsi }}</td>
                                        <td>{{ number_format($h->jumlah_poin) }} Poin</td>
                                        <td>{{ $h->stok }}</td>
                                        <td>
                                            @if ($h->status === 'aktif')
                                                <span class="badge bg-success text-white">Aktif</span>
                                            @else
                                                <span class="badge bg-danger text-white">Tidak Aktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-start">
                                                <a href="{{ route('admin.hadiah.edit', $h->id) }}" class="btn btn-sm btn-primary me-2">
                                                    <i class="fas fa-pencil-alt"></i> Edit
                                                </a>
                                                <form onsubmit="return confirm('Apakah Anda yakin?');" action="{{ route('admin.hadiah.destroy', $h->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            <div class="text-center">
                                                Belum ada hadiah.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection