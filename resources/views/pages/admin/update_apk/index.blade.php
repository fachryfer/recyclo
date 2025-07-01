@extends('layouts.app')

@section('title', 'Nasabah')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Manajem Aplikasi</h3>
            <h6 class="op-7 mb-2">Di sini, Anda dapat mengelola versi aplikasi Android untuk bank sampah.</h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            @if (isset($aplikasi))
                <!-- Jika sudah ada aplikasi, tombol tidak ditampilkan -->
            @else
                <div class="section-header-button">
                    <a href="{{ route('admin.aplikasi.create') }}" class="btn btn-primary btn-round">Upload Aplikasi</a>
                </div>
            @endif

        </div>
    </div>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card">
        <div class="card-header">
            <h4>Informasi Aplikasi</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Bagian tabel informasi aplikasi -->
                <div class="col-6">
                    <div class="card-body">
                        @if ($aplikasi)
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td><strong>Nama Aplikasi</strong></td>
                                        <td>:</td>
                                        <td>{{ $aplikasi->nama_file }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Versi Aplikasi</strong></td>
                                        <td>:</td>
                                        <td>{{ $aplikasi->versi_aplikasi }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Ukuran File</strong></td>
                                        <td>:</td>
                                        <td>{{ number_format($aplikasi->ukuran_file / 1024, 2) }} KB</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Keterangan</strong></td>
                                        <td>:</td>
                                        <td>{{ $aplikasi->keterangan ?? '-' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="mt-3">
                                <!-- Tombol Update APK -->
                                <a href="{{ route('admin.aplikasi.edit', $aplikasi->id) }}" class="btn btn-info">Update
                                    APK</a>

                                <!-- Tombol Download APK -->
                                <a href="{{ asset('storage/aplikasi/' . $aplikasi->nama_file) }}" class="btn btn-dark"
                                    download>Download APK</a>
                            </div>
                        @else
                            <p>Tidak ada aplikasi yang diupload. Silakan upload aplikasi terlebih dahulu.</p>
                        @endif
                    </div>
                </div>


                <div class="col-6">
                    <img src="{{ asset('assets/img/illustrasi_android.png') }}" width="500" class="img-responsive">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
