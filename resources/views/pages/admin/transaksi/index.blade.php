@extends('layouts.app')

@section('title', 'Daftar Transaksi')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Transaksi</h3>
            <h6 class="op-7 mb-2">
                Anda dapat mengelola semua transaksi, seperti mengedit, menghapus, dan lainnya.
            </h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <div class="section-header-button">
                <a href="{{ route('admin.transaksi.create') }}" class="btn btn-primary btn-round">Tambah Setoran</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="clearfix mb-3"></div>
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-head-bg-primary">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal Setoran</th>
                                    <th>Nama Nasabah</th>
                                    <th>Berat (kg)</th>
                                    <th>Total (Rp)</th>
                                    <th style="width: 250px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transaksis as $index => $transaksi)
                                    <tr>
                                        <td>{{ $transaksis->firstItem() + $index }}</td>
                                        <td>{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d-m-Y') }}</td>
                                        <td>{{ $transaksi->nasabah->nama_lengkap }}</td>
                                        <td>{{ number_format($transaksi->total_berat, 2, ',', '.') }}</td>
                                        <td>Rp{{ number_format($transaksi->total_transaksi, 0, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ route('admin.transaksi.show', $transaksi->id) }}"
                                                class="btn btn-sm btn-info me-2">
                                                <i class="fas fa-info-circle"></i> Detail
                                            </a>
                                            <a href="{{ route('admin.transaksi.print', $transaksi->id) }}"
                                                class="btn btn-sm btn-primary me-2">
                                                <i class="fas fa-print"></i> Cetak
                                            </a>
                                            {{-- <form onsubmit="return confirm('Apakah Anda yakin?');"
                                                action="{{ route('admin.transaksi.destroy', $transaksi->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fa-solid fa-trash"></i> Hapus
                                                </button>
                                            </form> --}}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <div class="text-center">Belum ada transaksi.</div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>
                    <div class="float-right">
                        {{ $transaksis->withQueryString()->links() }}
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
