@extends('layouts.app')

@section('title', 'Update APK')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Edit APK</h3>
            <h6 class="op-7 mb-2">Di halaman ini Anda dapat mengedit atau mengupdate file APK yang telah diunggah sebelumnya.
            </h6>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form action="{{ route('admin.aplikasi.update', $aplikasi->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-header">
                        <h4>Detail APK</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama_file">Nama APK</label>
                            <input type="text" id="nama_file"
                                class="form-control @error('nama_file') is-invalid @enderror" name="nama_file"
                                value="{{ $aplikasi->nama_file }}" readonly>
                            @error('nama_file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="apk_file">File APK (Kosongkan jika tidak ingin mengubah file)</label> <br>
                            <input type="file" id="apk_file"
                                class="form-control-file @error('apk_file') is-invalid @enderror" name="apk_file">
                            @error('apk_file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="versi_aplikasi">Versi</label>
                            <input type="text" id="versi_aplikasi"
                                class="form-control @error('versi_aplikasi') is-invalid @enderror" name="versi_aplikasi"
                                value="{{ $aplikasi->versi_aplikasi }}" required>
                            @error('versi_aplikasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Catatan Rilis</label>
                            <textarea data-height="150" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                                name="keterangan" rows="4">{{ old('keterangan', $aplikasi->keterangan) }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Update APK</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
