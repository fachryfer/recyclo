@extends('layouts.app')

@section('title', 'Edit Sampah')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Form Edit Sampah</h3>
            <h6 class="op-7 mb-2">
                Silakan isi form di bawah ini untuk mengedit sampah.
            </h6>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Informasi Sampah</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.sampah.update', $sampah->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Nama Sampah</label>
                            <input type="text" class="form-control" name="nama_sampah" value="{{ $sampah->nama_sampah }}"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Harga per Kg</label>
                            <input type="number" step="0.01" class="form-control" name="harga_per_kg"
                                value="{{ $sampah->harga_per_kg }}" required>
                        </div>
                        <div class="form-group">
                            <label>Gambar</label>
                            <input type="file" class="form-control" name="gambar" accept="image/*">
                            @if ($sampah->gambar)
                                <img src="{{ asset('storage/sampah/' . $sampah->gambar) }}" alt="Gambar Sampah"
                                    class="img-thumbnail mt-3" width="150">
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('admin.sampah.index') }}" class="btn btn-secondary">Batal</a>
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
