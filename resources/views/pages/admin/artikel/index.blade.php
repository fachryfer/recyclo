@extends('layouts.app')

@section('title', 'Daftar Artikel')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Artikel</h3>
            <h6 class="op-7 mb-2">Anda dapat mengelola semua artikel, seperti mengedit, menghapus, dan lainnya.</h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <div class="section-header-button">
                <a href="{{ route('admin.artikel.create') }}" class="btn btn-primary btn-round">Buat Artikel</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="clearfix mb-3"></div>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-head-bg-primary">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Judul Postingan</th>
                                    <th>Thumbnail</th>
                                    <th>Tanggal Posting</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($artikels as $index => $artikel)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $artikel->judul_postingan }}</td>
                                        <td>
                                            @if ($artikel->thumbnail)
                                                <img src="{{ asset('storage/thumbnail/' . $artikel->thumbnail) }}"
                                                    alt="Thumbnail" width="50">
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $artikel->created_at->format('d M Y') }}</td>
                                        <td>
                                            <a href="{{ route('admin.artikel.show', $artikel->id) }}"
                                                class="btn btn-sm btn-info">Detail</a>
                                            <a href="{{ route('admin.artikel.edit', $artikel->id) }}"
                                                class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('admin.artikel.destroy', $artikel->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="float-right">
                        {{ $artikels->withQueryString()->links() }}
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
