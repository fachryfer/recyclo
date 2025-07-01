@extends('layouts.app')

@section('title', 'Token WhatsApp')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Token WhatsApp</h3>
            <h6 class="op-7 mb-2">Di sini, Anda dapat mengelola token WhatsApp untuk aplikasi.</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Informasi Token WhatsApp</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <img src="{{ asset('assets/img/team_work.png') }}" width="500" class="img-responsive">
                </div>
                <div class="col-6">
                    <form action="{{ route('admin.token-whatsapp.update') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="token_whatsapp">Token WhatsApp</label>
                            <input type="text" name="token_whatsapp" class="form-control" id="token_whatsapp"
                                value="{{ $token->token_whatsapp ?? '' }}" required>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Update Token</button>
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
