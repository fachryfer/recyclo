@extends('layouts.app')

@section('title', 'Pengiriman Sampah')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Daftar Pengiriman Sampah</h3>
            <h6 class="op-7 mb-2">
                Anda dapat mengelola semua pengiriman sampah ke pengepul.
            </h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <div class="section-header-button">
                <a href="{{ route('admin.pengiriman.create') }}" class="btn btn-primary btn-round">Lakukan Pengiriman</a>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-head-bg-primary">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal Pengiriman</th>
                                    <th>Kode Pengiriman</th>
                                    <th>Nama Pengepul</th>
                                    <th>Total Berat (kg)</th>
                                    <th>Jumlah Jenis Sampah</th>
                                    {{-- <th>Aksi</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pengirimanSampah as $index => $pengiriman)
                                    <tr>
                                        <td>{{ $pengirimanSampah->firstItem() + $index }}</td>
                                        <td>{{ $pengiriman->tanggal_pengiriman }}</td>
                                        <td>{{ $pengiriman->kode_pengiriman }}</td>
                                        <td>{{ $pengiriman->pengepul->nama }}</td>
                                        <td>{{ $pengiriman->total_berat }}</td>
                                        <td>{{ $pengiriman->jumlah_jenis_sampah }}</td>
                                        {{-- <td>
                                        <form onsubmit="return confirm('Apakah Anda yakin?');"
                                                action="{{ route('pengiriman.destroy', $pengiriman->id) }}" method="POST">
                                                <a href="{{ route('pengiriman.edit', $pengiriman->id) }}"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="fa-solid fa-pencil"></i> Edit
                                                </a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fa-solid fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </td> --}}
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <div class="text-center">
                                                Belum ada pengiriman sampah.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="float-right">
                            {{ $pengirimanSampah->withQueryString()->links() }}
                        </div>
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
