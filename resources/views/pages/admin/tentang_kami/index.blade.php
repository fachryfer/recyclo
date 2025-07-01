@extends('layouts.app')

@section('title', 'Tentang Kami')

@push('style')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

@section('main')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Tentang Aplikasi</h3>
            <h6 class="op-7 mb-2">Halaman ini digunakan untuk menambahkan dan mengedit informasi mengenai "Tentang Kami".
                Anda dapat
                menyimpan detail tentang aplikasi ini dan memperbarui informasi yang ada.</h6>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <form method="POST"
                        action="{{ $tentangKami ? route('admin.tentang_kami.update', $tentangKami->id) : route('admin.tentang_kami.store') }}">
                        @csrf
                        @if ($tentangKami)
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <textarea name="isi_tentang_kami" id="summernote"
                                class="summernote form-control @error('isi_tentang_kami') is-invalid @enderror">
                            {{ old('isi_tentang_kami', $tentangKami->isi_tentang_kami ?? '') }}
                        </textarea>

                            @error('isi_tentang_kami')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">{{ $tentangKami ? 'Update' : 'Tambah' }}</button>
                        </div>
                    </form>
                </div>
                <div class="col-6">
                    <img src="{{ asset('assets/img/team_work.png') }}" width="500" class="img-responsive">
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 500, // Tinggi editor
                placeholder: 'Masukkan konten di sini...',
                tabsize: 2,
                toolbar: [
                    ['style', ['bold', 'italic', 'strikethrough',
                        'underline', 'fontname', 'fontsize', 'fontsizeunit', 'forecolor',
                        'backcolor', 'ul', 'ol', 'paragraph', 'height', 'undo', 'redo'
                    ]], // Tools yang diaktifkan
                ]
            });
        });
    </script>
@endpush
