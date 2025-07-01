@extends('layouts.app')

@section('title', 'Buat Pengajuan Penukaran Hadiah')

@push('style')
<style>
    .form-section {
        background: linear-gradient(135deg, #dbeafe, #f0f9ff);
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .form-title {
        color: #1e40af;
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #93c5fd;
    }
    .form-label {
        font-weight: 500;
        color: #1e3a8a;
    }
    .form-control {
        border: 1px solid #93c5fd;
        border-radius: 8px;
        padding: 0.75rem;
        transition: all 0.3s ease;
    }
    .form-control:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    .btn-submit {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(37, 99, 235, 0.2);
    }
    .alert {
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1.5rem;
    }
    .alert-success {
        background-color: #dcfce7;
        border-color: #86efac;
        color: #166534;
    }
    .alert-danger {
        background-color: #fee2e2;
        border-color: #fca5a5;
        color: #991b1b;
    }
    .poin-badge {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 0.875rem;
        font-weight: 500;
    }
</style>
@endpush

@section('main')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Buat Pengajuan Penukaran Hadiah</h3>
            <h6 class="op-7 mb-2">Buat pengajuan penukaran hadiah untuk nasabah.</h6>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <div class="form-section">
        <form action="{{ route('admin.penukaran-hadiah.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nasabah_id" class="form-label">Nasabah</label>
                    <select name="nasabah_id" id="nasabah_id" class="form-control" required>
                        <option value="">Pilih Nasabah</option>
                        @foreach($nasabah as $n)
                            <option value="{{ $n->id }}" data-poin="{{ $n->poinNasabah ? $n->poinNasabah->jumlah_poin : 0 }}">
                                {{ $n->nama_lengkap }} 
                                <span class="poin-badge">
                                    {{ number_format($n->poinNasabah ? $n->poinNasabah->jumlah_poin : 0, 0, ',', '.') }} Poin
                                </span>
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="hadiah_id" class="form-label">Hadiah</label>
                    <select name="hadiah_id" id="hadiah_id" class="form-control" required>
                        <option value="">Pilih Hadiah</option>
                        @foreach($hadiah as $h)
                            <option value="{{ $h->id }}" data-poin="{{ $h->jumlah_poin }}">
                                {{ $h->nama_hadiah }} 
                                <span class="poin-badge">
                                    {{ number_format($h->jumlah_poin, 0, ',', '.') }} Poin
                                </span>
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 mb-3">
                    <label for="keterangan" class="form-label">Keterangan (Opsional)</label>
                    <textarea name="keterangan" id="keterangan" class="form-control" rows="3" placeholder="Tambahkan keterangan jika diperlukan"></textarea>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-submit">Buat Pengajuan</button>
                    <a href="{{ route('admin.penukaran-hadiah') }}" class="btn btn-secondary ms-2">Kembali</a>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nasabahSelect = document.getElementById('nasabah_id');
        const hadiahSelect = document.getElementById('hadiah_id');
        const submitBtn = document.querySelector('button[type="submit"]');

        function validatePoints() {
            const selectedNasabah = nasabahSelect.options[nasabahSelect.selectedIndex];
            const selectedHadiah = hadiahSelect.options[hadiahSelect.selectedIndex];

            if (selectedNasabah.value && selectedHadiah.value) {
                const nasabahPoin = parseInt(selectedNasabah.dataset.poin);
                const hadiahPoin = parseInt(selectedHadiah.dataset.poin);

                if (nasabahPoin < hadiahPoin) {
                    submitBtn.disabled = true;
                    submitBtn.title = 'Poin nasabah tidak mencukupi';
                } else {
                    submitBtn.disabled = false;
                    submitBtn.title = '';
                }
            }
        }

        nasabahSelect.addEventListener('change', validatePoints);
        hadiahSelect.addEventListener('change', validatePoints);
    });
</script>
@endpush 