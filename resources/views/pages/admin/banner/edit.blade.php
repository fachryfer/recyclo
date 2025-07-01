@extends('layouts.app')

@section('title', 'Tambah Banner')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Form Tambah Banner</h3>
            <h6 class="op-7 mb-2">Di halaman ini Anda dapat mengedit banner.</h6>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Informasi Banner</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.banner.update', $banner->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Nama Banner</label>
                            <input type="text" class="form-control" name="nama_banner" value="{{ $banner->nama_banner }}"
                                required>
                        </div>
                        <div class="form-group">
                            <label>File Banner (Kosongkan jika tidak diubah)</label>
                            <input type="file" class="form-control" name="file_banner">
                            <br>
                            <h6>Banner Lama :</h6>
                            <img src="{{ asset('storage/banners/' . $banner->file_banner) }}"
                                alt="{{ $banner->nama_banner }}" width="100">

                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control" required>
                                <option value="aktif" {{ $banner->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="tidak_aktif" {{ $banner->status == 'tidak_aktif' ? 'selected' : '' }}>
                                    Tidak Aktif</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('admin.banner.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
