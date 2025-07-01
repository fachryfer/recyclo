@extends('layouts.app')

@section('title', 'Feedback')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Feedback</h3>
            <h6 class="op-7 mb-2">
                Anda dapat mengelola semua feedback yang masuk, seperti melihat detail dan menghapus
            </h6>
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
                                    <th>No</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Nama Pengirim</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($feedbacks as $index => $feedback)
                                    <tr>
                                        <td>{{ $feedbacks->firstItem() + $index }}</td>
                                        <td>{{ $feedback->created_at->format('d-m-Y H:i') }}</td>
                                        <td>{{ $feedback->nasabah->nama_lengkap }}</td>
                                        <td>
                                            <a href="{{ route('admin.feedback.show', $feedback->id) }}"
                                                class="btn btn-sm btn-info"><i class="fas fa-info-circle"></i> Detail</a>
                                            <form action="{{ route('admin.feedback.destroy', $feedback->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus feedback ini?')"><i
                                                        class="fas fa-trash"></i> Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="float-right">
                        {{ $feedbacks->withQueryString()->links() }}
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
