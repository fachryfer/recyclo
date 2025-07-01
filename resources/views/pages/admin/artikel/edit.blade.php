@extends('layouts.app')

@section('title', 'Edit Artikel')

@push('style')
    <!-- CSS Libraries -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

@section('main')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Form Edit Artikel</h3>
            <h6 class="op-7 mb-2">
                Di halaman ini Anda dapat mengedit artikel.
            </h6>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Informasi Artikel</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.artikel.update', $artikel->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Judul Postingan</label>
                            <input type="text" class="form-control" name="judul_postingan"
                                value="{{ $artikel->judul_postingan }}" required>
                        </div>

                        <div class="form-group">
                            <label>Isi Postingan</label>
                            <textarea name="isi_postingan" id="summernote"
                                class="summernote form-control @error('isi_postingan') is-invalid @enderror">
                            {{ old('isi_postingan', $artikel->isi_postingan ?? '') }}
                            </textarea>
                        </div>

                        <div class="form-group">
                            <label>Thumbnail</label>
                            <input type="file" class="form-control" name="thumbnail" accept="image/*">
                            @if ($artikel->thumbnail)
                                <img src="{{ asset('storage/thumbnail/' . $artikel->thumbnail) }}" alt="Thumbnail"
                                    class="img-thumbnail mt-3" width="150">
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Media Artikel (Maksimal 5 Gambar)</label>
                            <input type="file" class="form-control" name="media[]" accept="image/*" multiple>
                            <small class="text-danger">Maksimal 5 gambar</small>
                            <div class="mt-3">
                                @foreach ($artikel->media as $media)
                                    <img src="{{ asset('storage/media/' . $media->file_gambar) }}" alt="Media Artikel"
                                        class="img-thumbnail" width="100" style="margin: 5px;">
                                @endforeach
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('admin.artikel.index') }}" class="btn btn-secondary">Batal</a>
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
