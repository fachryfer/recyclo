@extends('layouts.app')

@section('title', 'Daftar Banner')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">List Banner</h3>
            <h6 class="op-7 mb-2">Anda dapat mengelola semua banner, seperti mengedit, menghapus, dan lainnya.</h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <div class="section-header-button">
                <a href="{{ route('admin.banner.create') }}" class="btn btn-primary btn-round">Tambah Banner</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover table-bordered table-head-bg-primary">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Banner</th>
                                <th>File Banner</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($banners as $index => $banner)
                                <tr>
                                    <td>{{ $banners->firstItem() + $index }}</td>
                                    <td>{{ $banner->nama_banner }}</td>
                                    <td><img src="{{ asset('storage/banners/' . $banner->file_banner) }}" alt="Banner"
                                            width="100">
                                    </td>
                                    <td>
                                        @if ($banner->status === 'aktif')
                                            <span class="badge bg-success text-white">Aktif</span>
                                        @else
                                            <span class="badge bg-danger text-white">Tidak Aktif</span>
                                        @endif
                                    <td>
                                        <a href="{{ route('admin.banner.edit', $banner->id) }}"
                                            class="btn btn-warning">Edit</a>
                                        <form action="{{ route('admin.banner.destroy', $banner->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus banner ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
