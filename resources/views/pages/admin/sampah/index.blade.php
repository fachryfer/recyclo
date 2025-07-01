@extends('layouts.app')

@section('title', 'Sampah')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Daftar Sampah</h3>
            <h6 class="op-7 mb-2">
                Anda dapat mengelola semua sampah, seperti mengedit, menghapus, dan lainnya.
            </h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <div class="section-header-button">
                <a href="{{ route('admin.sampah.create') }}" class="btn btn-primary btn-round">Tambah Sampah</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-head-bg-primary">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Sampah</th>
                                    <th>Harga per Kg</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sampahs as $index => $sampah)
                                    <tr>
                                        <td>{{ $sampahs->firstItem() + $index }}</td>
                                        <td>{{ $sampah->nama_sampah }}</td>
                                        <td>Rp{{ number_format($sampah->harga_per_kg, 2, ',', '.') }}</td>
                                        <td>
                                            @if ($sampah->gambar)
                                                <img src="{{ asset('storage/sampah/' . $sampah->gambar) }}"
                                                    alt="{{ $sampah->nama_sampah }}" style="width: 150px; height: auto;">
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            <form onsubmit="return confirm('Apakah Anda yakin?');"
                                                action="{{ route('admin.sampah.destroy', $sampah->id) }}" method="POST">
                                                <a href="{{ route('admin.sampah.edit', $sampah->id) }}"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="fas fa-pencil-alt"></i> Edit
                                                </a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="float-right">
                        {{ $sampahs->links() }}
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
