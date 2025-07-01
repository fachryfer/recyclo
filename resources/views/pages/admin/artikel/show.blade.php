@extends('layouts.app')

@section('title', 'Detail Artikel')

@push('style')
    <!-- CSS Libraries -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

@section('main')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Detail Artikel
            </h3>
            <h6 class="op-7 mb-2">Di halaman ini Anda dapat melihat detail artikel.</h6>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Informasi Artikel</h4>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label>Judul Postingan</label>
                            <input type="text" class="form-control" name="judul_postingan"
                                value="{{ $artikel->judul_postingan }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Isi Postingan</label>
                            <textarea name="isi_postingan" id="summernote"
                                class="summernote form-control @error('isi_postingan') is-invalid @enderror">{{ $artikel->isi_postingan }}
                        </textarea>
                        </div>

                        <div class="form-group">
                            <label>Thumbnail</label><br>
                            @if ($artikel->thumbnail)
                                <img src="{{ asset('storage/thumbnail/' . $artikel->thumbnail) }}" alt="Thumbnail"
                                    style="max-width: 100%; height: auto;">
                            @else
                                <p class="text-muted">Tidak ada thumbnail</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Media Artikel</label><br>
                            @if ($artikel->media->isNotEmpty())
                                @foreach ($artikel->media as $media)
                                    <img src="{{ asset('storage/media/' . $media->file_gambar) }}" alt="Media"
                                        style="max-width: 100px; height: auto; margin-right: 10px;">
                                @endforeach
                            @else
                                <p class="text-muted">Tidak ada media</p>
                            @endif
                        </div>

                        <a href="{{ route('admin.artikel.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
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
                height: 400, // Tinggi editor
                placeholder: 'Masukkan konten di sini...',
                tabsize: 2,
                toolbar: [
                    ['style', ['bold', 'italic', 'strikethrough',
                        'underline', 'fontname', 'fontsize', 'fontsizeunit', 'forecolor',
                        'backcolor', 'ul', 'ol', 'paragraph', 'height', 'fullscreen', 'undo', 'redo'
                    ]], // Tools yang diaktifkan
                ]
            });
        });
    </script>
@endpush
