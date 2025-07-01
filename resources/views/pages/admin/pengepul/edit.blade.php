@extends('layouts.app')

@section('title', 'Edit Pengepul')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Form Tambah Pengepul</h3>
            <h6 class="op-7 mb-2">
                Di halaman ini Anda dapat menambah mengedit pengepul.
            </h6>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Informasi Pengepul</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.pengepul.update', $pengepul->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" value="{{ $pengepul->nama }}"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" name="alamat" data-height="150" required>{{ $pengepul->alamat }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Kontak</label>
                            <input type="text" class="form-control" name="kontak" value="{{ $pengepul->kontak }}"
                                required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('admin.pengepul.index') }}" class="btn btn-secondary">Batal</a>
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
