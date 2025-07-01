@extends('layouts.app')

@section('title', 'Pengajuan Saldo')

@section('main')
<div class="container">
    <h3 class="mb-4">Form Pengajuan Saldo</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('petugas.pengajuan_saldo.store') }}" method="POST" id="pengajuanForm">
        @csrf

        <!-- Nasabah -->
        <div class="form-group mb-3">
            <label for="nasabah_id">Nasabah</label>
            <select name="nasabah_id" id="nasabah_id" class="form-control" required>
                <option value="">-- Pilih Nasabah --</option>
                @foreach ($nasabah as $n)
                    <option value="{{ $n->id }}">{{ $n->nama_lengkap }}</option>
                @endforeach
            </select>
        </div>

        <!-- Metode Pencairan -->
        <div class="form-group mb-3">
            <label for="metode_pencairan">Metode Pencairan</label>
            <select name="metode_pencairan" id="metode_pencairan" class="form-control" required>
                <option value="">-- Pilih Metode --</option>
                <option value="tunai">💵 Tunai</option>
                <option value="transfer">🏦 Transfer Bank</option>
                <option value="dana">🟦 DANA</option>
                <option value="ovo">🟪 OVO</option>
                <option value="gopay">🟦 GoPay</option>
                <option value="shopeepay">🟧 ShopeePay</option>
            </select>
        </div>

        <!-- No Rekening -->
        <div class="form-group mb-3">
            <label for="no_rek">Nomor Rekening / No HP e-Wallet</label>
            <input type="text" name="no_rek" id="no_rek" class="form-control" disabled>
        </div>

        <!-- Jumlah Pencairan -->
        <div class="form-group mb-4">
            <label for="jumlah_pencairan">Jumlah Pencairan</label>
            <input type="number" name="jumlah_pencairan" id="jumlah_pencairan" class="form-control" required min="1000">
        </div>

        <button type="submit" class="btn btn-primary">Kirim Pengajuan</button>
    </form>
</div>

{{-- Optional: Tambah CDN Bootstrap Icons --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

{{-- Script toggle no_rek --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const metodeSelect = document.getElementById('metode_pencairan');
        const noRekInput = document.getElementById('no_rek');

        function toggleNoRek() {
            const metode = metodeSelect.value;
            if (metode && metode !== 'tunai') {
                noRekInput.disabled = false;
                noRekInput.required = true;
            } else {
                noRekInput.disabled = true;
                noRekInput.required = false;
                noRekInput.value = '';
            }
        }

        metodeSelect.addEventListener('change', toggleNoRek);
        toggleNoRek(); // on page load
    });
</script>
@endsection
