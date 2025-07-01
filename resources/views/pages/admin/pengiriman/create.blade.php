@extends('layouts.app')

@section('title', 'Pengiriman Sampah')

@push('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-5-theme/1.2.0/select2-bootstrap.min.css"
        rel="stylesheet">
@endpush

@section('main')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Formulir Pengiriman Sampah</h3>
            <h6 class="op-7 mb-2">
                Isi formulir di bawah untuk mencatat pengiriman sampah ke pengepul.
            </h6>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <form action="{{ route('admin.pengiriman.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">

                        <div class="form-group">
                            <label>Kode Pengiriman</label>
                            <input class="form-control" type="text" name="kode_pengiriman" value="{{ $kodePengiriman }}"
                                readonly>
                        </div>

                        <div class="form-group">
                            <label>Pilih Pengepul</label>
                            <select name="pengepul_id" class="form-control" required>
                                <option value="">-- Pilih Pengepul --</option>
                                @foreach ($pengepulList as $pengepul)
                                    <option value="{{ $pengepul->id }}">{{ $pengepul->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tanggal Pengiriman</label>
                            <input type="date" name="tanggal_pengiriman" value="{{ date('Y-m-d') }}" class="form-control"
                                required>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">

                        <div class="form-group">
                            <label>Detail Pengiriman</label>
                            <table class="table table-bordered" id="pengiriman-detail-table">
                                <thead>
                                    <tr>
                                        <th>Jenis Sampah</th>
                                        <th>Berat (Kg)</th>
                                        <th>Stok Tersedia (Kg)</th>
                                        <th>Harga/Kg (Rp)</th>
                                        <th>Harga Total (Rp)</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="pengiriman-details">
                                    <tr>
                                        <td>
                                            <select name="sampah_id[]" class="form-control sampah-select" required>
                                                <option value="">-- Pilih Sampah --</option>
                                                @foreach ($stokSampah as $sampah)
                                                    <option value="{{ $sampah->id }}" data-stok="{{ $sampah->stok }}">
                                                        {{ $sampah->nama_sampah }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="berat_kg[]" class="form-control berat-input"
                                                placeholder="Berat (kg)" required>
                                        </td>
                                        <td class="stok-tersedia"></td>
                                        <td>
                                            <input type="number" name="harga_per_kg[]" class="form-control harga-input"
                                                placeholder="Harga per Kg" required>
                                        </td>
                                        <td class="harga-total">0</td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm remove-row">Hapus</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-success" id="add-row">Tambah Jenis Sampah</button>
                        </div>

                        <div class="form-group mt-4">
                            <label>Total Harga (Rp)</label>
                            <input type="text" id="total-harga" class="form-control" value="0" readonly>
                        </div>

                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Lakukan Pengiriman</button>
                        </div>
                    </div>
                </div>
            </form>
            @if (session('success'))
                <script>
                    alert('{{ session('success') }}');
                    window.open("{{ route('admin.pengiriman.print', session('pengiriman_id')) }}", '_blank');
                </script>
            @endif

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Tambahkan baris baru
            $('#add-row').on('click', function() {
                let newRow = `
                <tr>
                    <td>
                        <select name="sampah_id[]" class="form-control sampah-select" required>
                            <option value="">-- Pilih Sampah --</option>
                            @foreach ($stokSampah as $sampah)
                                <option value="{{ $sampah->id }}" data-stok="{{ $sampah->stok }}">
                                    {{ $sampah->nama_sampah }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="berat_kg[]" class="form-control berat-input" placeholder="Berat (kg)" required></td>
                    <td class="stok-tersedia"></td>
                    <td><input type="number" name="harga_per_kg[]" class="form-control harga-input" placeholder="Harga per Kg" required></td>
                    <td class="harga-total">0</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm remove-row">Hapus</button>
                    </td>
                </tr>`;
                $('#pengiriman-details').append(newRow);
            });

            // Hapus baris
            $(document).on('click', '.remove-row', function() {
                $(this).closest('tr').remove();
                calculateTotalPrice();
            });

            // Validasi duplikasi jenis sampah
            $(document).on('change', 'select[name="sampah_id[]"]', function() {
                let selectedValue = $(this).val();
                let isDuplicate = false;

                $('select[name="sampah_id[]"]').not(this).each(function() {
                    if ($(this).val() === selectedValue) {
                        isDuplicate = true;
                        return false;
                    }
                });

                if (isDuplicate) {
                    alert('Jenis sampah ini sudah dipilih!');
                    $(this).val(''); // Reset value
                } else {
                    let stokTersedia = $(this).find(':selected').data('stok') || 0;
                    $(this).closest('tr').find('.stok-tersedia').text(`${stokTersedia} kg`);
                }
            });

            // Validasi berat terhadap stok tersedia
            $(document).on('input', '.berat-input', function() {
                let beratInput = parseFloat($(this).val()) || 0;
                let stokTersedia = parseFloat($(this).closest('tr').find('.stok-tersedia').text()) || 0;

                if (beratInput > stokTersedia) {
                    alert('Berat tidak boleh melebihi stok yang tersedia!');
                    $(this).val('');
                }
                calculateRowPrice($(this).closest('tr'));
                calculateTotalPrice();
            });

            // Perhitungan harga total per baris
            $(document).on('input', '.berat-input, .harga-input', function() {
                calculateRowPrice($(this).closest('tr'));
                calculateTotalPrice();
            });

            // Fungsi untuk menghitung harga total per baris
            function calculateRowPrice(row) {
                let berat = parseFloat(row.find('.berat-input').val()) || 0;
                let hargaPerKg = parseFloat(row.find('.harga-input').val()) || 0;
                let hargaTotal = berat * hargaPerKg;
                row.find('.harga-total').text(hargaTotal.toLocaleString('id-ID'));
            }

            // Fungsi untuk menghitung total harga keseluruhan
            function calculateTotalPrice() {
                let totalPrice = 0;

                $('#pengiriman-details tr').each(function() {
                    let berat = parseFloat($(this).find('.berat-input').val()) || 0;
                    let hargaPerKg = parseFloat($(this).find('.harga-input').val()) || 0;
                    totalPrice += berat * hargaPerKg;
                });

                $('#total-harga').val(totalPrice.toLocaleString('id-ID'));
            }
        });
    </script>
@endpush
