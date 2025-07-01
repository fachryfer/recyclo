@extends('layouts.app')

@section('title', 'Detail Feedback')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Detail Feedback</h3>
            <h6 class="op-7 mb-2">
                Di halaman ini Anda dapat melihat feedback yang masuk.
            </h6>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Detail Feedback</h4>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label><strong>Subjek:</strong></label>
                            <input type="text" class="form-control" value="{{ $feedback->judul_feedback }}" disabled>
                        </div>
                        <div class="form-group">
                            <label><strong>Nama Pengirim:</strong></label>
                            <input type="text" class="form-control" value="{{ $feedback->nasabah->nama_lengkap }}"
                                disabled>
                        </div>
                        <div class="form-group">
                            <label><strong>Isi Feedback:</strong></label>
                            <textarea class="form-control" data-height="150" disabled>{{ $feedback->isi_feedback }}</textarea>
                        </div>
                        <div class="form-group">
                            <label><strong>Tanggal Masuk:</strong></label>
                            <input type="text" class="form-control"
                                value="{{ $feedback->created_at->format('d-m-Y H:i') }}" disabled>
                        </div>
                        <div class="form-group">
                            <a href="{{ route('admin.feedback.index') }}" class="btn btn-secondary">Kembali</a>
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
