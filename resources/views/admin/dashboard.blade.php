@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-4 align-items-center">
        <div class="col">
            <h2 class="fw-bold text-dark">📊 Dashboard Rekap Pesanan</h2>
            <p class="text-muted small mb-0">Daftar seluruh pesanan masuk dari pelanggan Burgerban.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Tabel Rekap Data -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th class="py-3 ps-4">No</th>
                        <th class="py-3">Tanggal / Waktu</th>
                        <th class="py-3">Nama Penerima</th>
                        <th class="py-3">No. HP</th>
                        <th class="py-3">Menu Dipesan</th>
                        <th class="py-3">Total Harga</th>
                        <th class="py-3">Pembayaran</th>
                        <th class="py-3">Alamat</th>
                        <th class="py-3 pe-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $index => $order)
                    <tr>
                        <td class="ps-4 fw-bold text-muted">{{ $index + 1 }}</td>
                        <td><small class="text-muted">{{ $order->created_at->format('d M Y, H:i') }}</small></td>
                        <td class="fw-bold text-dark">{{ $order->name }}</td>
                        <td>
                            <a href="https://wa.me/{{ preg_replace('/^0/', '62', $order->phone) }}" target="_blank" class="text-success text-decoration-none fw-semibold">
                                <i class="fab fa-whatsapp me-1"></i> {{ $order->phone }}
                            </a>
                        </td>
                        <td><span class="badge bg-light text-dark border px-2 py-1">{{ $order->item_ordered }}</span></td>
                        <td class="fw-bold text-danger">Rp {{ number_format($order->price, 0, ',', '.') }}</td>
                        <td><span class="badge bg-secondary">{{ $order->payment_method }}</span></td>
                        <td><small class="text-muted text-truncate d-inline-block" style="max-width: 150px;" title="{{ $order->address }}">{{ $order->address }}</small></td>
                        <td class="pe-4 text-center">
                            <!-- Tombol Hapus dengan Konfirmasi -->
                            <form action="{{ route('admin.order.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesanan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3 py-1" style="font-size: 11px;">
                                    <i class="fas fa-trash-alt me-1"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-4 text-muted">Belum ada pesanan yang masuk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection