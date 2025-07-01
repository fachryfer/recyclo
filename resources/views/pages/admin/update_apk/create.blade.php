@extends('layouts.app')

@section('title', 'Nasabah')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Upload APK</h3>
            <h6 class="op-7 mb-2">Di halaman ini Anda dapat mengunggah file APK terbaru untuk aplikasi Android.</h6>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form action="{{ route('admin.aplikasi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                        <h4>Detail APK</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama_file">Nama APK</label>
                            <input type="text" id="nama_file" class="form-control" name="nama_file"
                                value="Bank Sampah Rendole Pati" disabled>
                            <input type="hidden" name="nama_file" value="Bank Sampah Rendole Pati">
                        </div>
                        <div class="form-group">
                            <label for="apk_file">File APK</label> <br>
                            <input type="file" id="apk_file"
                                class="form-control-file @error('apk_file') is-invalid @enderror" name="apk_file" required>
                            @error('apk_file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="versi_aplikasi">Versi</label>
                            <input type="text" id="versi_aplikasi"
                                class="form-control @error('versi_aplikasi') is-invalid @enderror" name="versi_aplikasi"
                                value="{{ old('versi_aplikasi') }}" required>
                            @error('versi_aplikasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Catatan Rilis</label>
                            <textarea data-height="150" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                                name="keterangan" rows="4">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Unggah APK</button>
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
