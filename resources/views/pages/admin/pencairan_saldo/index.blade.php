@extends('layouts.app')

@section('title', 'Pengajuan Tarik Saldo')

@push('style')
    <style>
        .bg-metode-pencairan {
            background: linear-gradient(135deg, #dbeafe, #f0f9ff);
            color: #333;
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .bg-metode-pencairan img {
            width: 20px;
            height: auto;
            display: inline-block;
        }
    </style>
@endpush

@section('main')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Permintaan Penarikan Saldo</h3>
            <h6 class="op-7 mb-2">Anda dapat mengelola permintaan penarikan saldo yang masuk.</h6>
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

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-head-bg-primary">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Nama Nasabah</th>
                            <th>Jumlah Penarikan</th>
                            <th>Metode Pencairan</th>
                            <th>No Rekening</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pencairanSaldo as $index => $pencairan)
                            <tr>
                                <td>{{ $pencairanSaldo->firstItem() + $index }}</td>
                                <td>{{ \Carbon\Carbon::parse($pencairan->tanggal_pengajuan)->format('d-m-Y H:i') }}</td>
                                <td>{{ $pencairan->nasabah->nama_lengkap }}</td>
                                <td>Rp{{ number_format($pencairan->jumlah_pencairan, 0, ',', '.') }}</td>
                                <td>
                                    <span class="bg-metode-pencairan">
                                        @php
                                            $logoFile = 'tunai.png'; // default logo
                                            $metode = strtolower($pencairan->metode_pencairan);

                                            if (str_contains($metode, 'bank') || $metode === 'transfer') {
                                                $logoFile = 'bank.png';
                                            } elseif ($metode === 'ovo') {
                                                $logoFile = 'ovo.png';
                                            } elseif ($metode === 'dana') {
                                                $logoFile = 'dana.png';
                                            } elseif ($metode === 'gopay') {
                                                $logoFile = 'gopay.png';
                                            } elseif ($metode === 'shopeepay') {
                                                $logoFile = 'shopeepay.png';
                                            } elseif ($metode === 'tunai') {
                                                $logoFile = 'tunai.png';
                                            }
                                        @endphp
                                        <img src="{{ asset('assets/img/metode/' . $logoFile) }}" alt="{{ $pencairan->metode_pencairan }}">
                                        {{ ucfirst($pencairan->metode_pencairan) }}
                                    </span>
                                </td>
                                <td>{{ $pencairan->no_rek ?? '-' }}</td>
                                <td>{{ $pencairan->keterangan ?? '-' }}</td>
                                <td>
                                    @if($pencairan->status == 'pending')
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif($pencairan->status == 'disetujui')
                                        <span class="badge badge-success">Disetujui</span>
                                    @else
                                        <span class="badge badge-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    @if($pencairan->status == 'pending')
                                        <div class="d-flex">
                                            <form action="{{ route('admin.tarik-saldo.setujui', $pencairan->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm me-2" onclick="return confirm('Setujui pengajuan ini?')">Setujui</button>
                                            </form>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalTolak" onclick="setRejectData({{ $pencairan->id }})">Tolak</button>
                                        </div>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="9" class="text-center">Tidak ada pengajuan saldo.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="float-right">
                {{ $pencairanSaldo->withQueryString()->links() }}
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTolak" tabindex="-1" role="dialog" aria-labelledby="modalTolakLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" id="formTolak">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tolak Pengajuan</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Tutup">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="tolakId">
                        <div class="form-group">
                            <label for="keterangan">Keterangan Penolakan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Tolak</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function setRejectData(id) {
        const url = "{{ route('admin.tarik-saldo.tolak', ':id') }}".replace(':id', id);
        document.getElementById('formTolak').action = url;
        document.getElementById('tolakId').value = id;
    }
</script>
@endpush
