@extends('layouts.app')

@section('title', 'Laporan')

@section('main')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Filter Laporan</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.laporan.index') }}" method="GET">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="jenis_laporan">Jenis Laporan</label>
                                    <select name="jenis_laporan" id="jenis_laporan" class="form-control" required>
                                        <option value="">-- Pilih Jenis Laporan --</option>
                                        <option value="transaksi"
                                            {{ request('jenis_laporan') == 'transaksi' ? 'selected' : '' }}>Laporan
                                            Transaksi</option>
                                        <option value="pencairan"
                                            {{ request('jenis_laporan') == 'pencairan' ? 'selected' : '' }}>Laporan
                                            Pencairan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tanggal_awal">Tanggal Awal</label>
                                    <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control"
                                        value="{{ request('tanggal_awal') }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tanggal_akhir">Tanggal Akhir</label>
                                    <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control"
                                        value="{{ request('tanggal_akhir') }}" required>
                                </div>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary btn-block">Tampilkan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tampilkan hasil laporan -->
    @if (request()->filled('jenis_laporan'))
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Hasil Laporan {{ ucfirst(request('jenis_laporan')) }}</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    @if (request('jenis_laporan') === 'transaksi')
                                        <th>#</th>
                                        <th>Kode Transaksi</th>
                                        <th>Nasabah</th>
                                        <th>Petugas</th>
                                        <th>Tanggal Transaksi</th>
                                    @else
                                        <th>#</th>
                                        <th>Nasabah</th>
                                        <th>Metode</th>
                                        <th>Jumlah Pencairan</th>
                                        <th>Status</th>
                                        <th>Tanggal Pengajuan</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @if (request('jenis_laporan') === 'transaksi')
                                    @forelse($laporanTransaksi as $index => $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->kode_transaksi }}</td>
                                            <td>{{ $item->nasabah->nama_lengkap }}</td>
                                            <td>{{ $item->petugas->nama }}</td>
                                            <td>{{ $item->tanggal_transaksi }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada data.</td>
                                        </tr>
                                    @endforelse
                                @else
                                    @forelse($laporanPencairan as $index => $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nasabah->nama_lengkap }}</td>
                                            <td>{{ $item->metode_pencairan }}</td>
                                            <td>{{ $item->jumlah_pencairan }}</td>
                                            <td>{{ ucfirst($item->status) }}</td>
                                            <td>{{ $item->tanggal_pengajuan }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada data.</td>
                                        </tr>
                                    @endforelse
                                @endif
                            </tbody>
                        </table>
                        <a href="{{ route('admin.laporan.print', request()->all()) }}" target="_blank"
                            class="btn btn-secondary mt-3">Cetak Laporan</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
