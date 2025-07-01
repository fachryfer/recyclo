@extends('layouts.app')

@section('title', 'Penukaran Hadiah')

@push('style')
    <style>
        .bg-hadiah {
            background: linear-gradient(135deg, #dbeafe, #f0f9ff);
            color: #333;
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .bg-hadiah img {
            width: 40px;
            height: 40px;
            object-fit: contain;
            display: inline-block;
        }
        .btn-create {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-create:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(37, 99, 235, 0.2);
            color: white;
        }
        .gambar-penukaran {
            max-width: 100px;
            max-height: 100px;
            object-fit: contain;
            border-radius: 4px;
            cursor: pointer;
        }
        .gambar-penukaran:hover {
            transform: scale(1.1);
            transition: transform 0.3s ease;
        }
    </style>
@endpush

@section('main')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Permintaan Penukaran Hadiah</h3>
            <h6 class="op-7 mb-2">Anda dapat mengelola permintaan penukaran hadiah yang masuk.</h6>
        </div>
        <div class="ms-md-auto">
            <a href="{{ route('admin.penukaran-hadiah.create') }}" class="btn btn-create">
                <i class="fas fa-plus me-2"></i>Buat Pengajuan Baru
            </a>
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
                            <th>Hadiah</th>
                            <th>Harga Reedem</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($penukaranHadiah as $index => $penukaran)
                            <tr>
                                <td>{{ $penukaranHadiah->firstItem() + $index }}</td>
                                <td>{{ \Carbon\Carbon::parse($penukaran->created_at)->format('d-m-Y H:i') }}</td>
                                <td>{{ $penukaran->nasabah->nama_lengkap }}</td>
                                <td>
                                    <span class="bg-hadiah">
                                        @if($penukaran->hadiah->gambar)
                                            <img src="{{ Storage::url($penukaran->hadiah->gambar) }}" alt="{{ $penukaran->hadiah->nama_hadiah }}" style="width: 40px; height: 40px; object-fit: contain;">
                                        @else
                                            <img src="{{ asset('assets/img/hadiah/default.png') }}" alt="{{ $penukaran->hadiah->nama_hadiah }}" style="width: 40px; height: 40px; object-fit: contain;">
                                        @endif
                                        {{ $penukaran->hadiah->nama_hadiah }}
                                    </span>
                                </td>
                                <td>{{ number_format($penukaran->hadiah->jumlah_poin, 0, ',', '.') }}</td>
                                <td>
                                    @if($penukaran->status == 'pending')
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif($penukaran->status == 'disetujui')
                                        <span class="badge badge-success">Disetujui</span>
                                    @else
                                        <span class="badge badge-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td>{{ $penukaran->keterangan ?? '-' }}</td>
                                <td>
                                    @if($penukaran->gambar)
                                        <img src="{{ asset('storage/penukaran_hadiah/' . $penukaran->gambar) }}" 
                                             alt="Gambar Penukaran" 
                                             class="gambar-penukaran"
                                             onclick="showImage(this.src, {{ $penukaran->id }}, '{{ $penukaran->gambar }}', '{{ $penukaran->status }}')">
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($penukaran->status == 'pending')
                                        <div class="d-flex">
                                            <button type="button" class="btn btn-success btn-sm me-2" data-bs-toggle="modal" data-bs-target="#modalSetujui" onclick="setApproveData({{ $penukaran->id }})">Setujui</button>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalTolak" onclick="setRejectData({{ $penukaran->id }})">Tolak</button>
                                        </div>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="9" class="text-center">Tidak ada pengajuan penukaran hadiah.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="float-right">
                {{ $penukaranHadiah->withQueryString()->links() }}
            </div>
        </div>
    </div>

    <!-- Modal Setujui -->
    <div class="modal fade" id="modalSetujui" tabindex="-1" role="dialog" aria-labelledby="modalSetujuiLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" id="formSetujui" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Setujui Penukaran Hadiah</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Tutup">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="setujuiId">
                        <div class="form-group">
                            <label for="gambar">Upload Gambar Voucher/Hadiah</label>
                            <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*" required>
                            <small class="text-muted">Upload gambar voucher atau bukti hadiah yang akan diberikan</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Setujui</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Tolak -->
    <div class="modal fade" id="modalTolak" tabindex="-1" role="dialog" aria-labelledby="modalTolakLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" id="formTolak">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tolak Penukaran Hadiah</h5>
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

    <!-- Modal Preview Gambar -->
    <div class="modal fade" id="modalPreview" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Preview Gambar</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img id="previewImage" src="" alt="Preview" style="max-width: 100%; max-height: 80vh;">
                    <div id="actionButtons" class="mt-3" style="display: none;">
                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#modalEditGambar" onclick="setEditGambarData()">
                            <i class="fas fa-edit"></i> Edit Gambar
                        </button>
                        <button type="button" class="btn btn-danger" onclick="confirmDeleteGambar()">
                            <i class="fas fa-trash"></i> Hapus Gambar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Gambar -->
    <div class="modal fade" id="modalEditGambar" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" id="formEditGambar" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Gambar Penukaran</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Tutup">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editGambarId">
                        <div class="form-group">
                            <label for="edit_gambar">Gambar Baru</label>
                            <input type="file" name="gambar" id="edit_gambar" class="form-control" accept="image/*" required>
                            <small class="text-muted">Upload gambar baru untuk mengganti gambar yang ada</small>
                        </div>
                        <div class="mt-3">
                            <label>Gambar Saat Ini:</label>
                            <img id="currentGambar" src="" alt="Current Image" class="img-fluid mt-2" style="max-height: 200px;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Update Gambar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Form Hapus Gambar (Hidden) -->
    <form id="formDeleteGambar" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('scripts')
<script>
    let currentPenukaranId = null;
    let currentGambar = null;

    function setApproveData(id) {
        const url = "{{ route('admin.penukaran-hadiah.setujui', ':id') }}".replace(':id', id);
        document.getElementById('formSetujui').action = url;
        document.getElementById('setujuiId').value = id;
    }

    function setRejectData(id) {
        const url = "{{ route('admin.penukaran-hadiah.tolak', ':id') }}".replace(':id', id);
        document.getElementById('formTolak').action = url;
        document.getElementById('tolakId').value = id;
    }

    function showImage(src, id, gambar, status) {
        document.getElementById('previewImage').src = src;
        currentPenukaranId = id;
        currentGambar = gambar;
        
        // Tampilkan tombol aksi hanya jika status disetujui
        const actionButtons = document.getElementById('actionButtons');
        if (status === 'disetujui') {
            actionButtons.style.display = 'block';
        } else {
            actionButtons.style.display = 'none';
        }
        
        new bootstrap.Modal(document.getElementById('modalPreview')).show();
    }

    function setEditGambarData() {
        if (!currentPenukaranId) return;
        
        const url = "{{ route('admin.penukaran-hadiah.update-gambar', ':id') }}".replace(':id', currentPenukaranId);
        document.getElementById('formEditGambar').action = url;
        document.getElementById('editGambarId').value = currentPenukaranId;
        document.getElementById('currentGambar').src = "{{ asset('storage/penukaran_hadiah/') }}/" + currentGambar;
        
        // Tutup modal preview
        bootstrap.Modal.getInstance(document.getElementById('modalPreview')).hide();
    }

    function confirmDeleteGambar() {
        if (!currentPenukaranId) return;
        
        if (confirm('Apakah Anda yakin ingin menghapus gambar ini?')) {
            const url = "{{ route('admin.penukaran-hadiah.delete-gambar', ':id') }}".replace(':id', currentPenukaranId);
            const form = document.getElementById('formDeleteGambar');
            form.action = url;
            form.submit();
        }
    }
</script>
@endpush 