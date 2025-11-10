<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Riwayat Pemesanan - ECOSEND</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- MIDTRANS SNAP SANDBOX --}}
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="Mid-client-8XGnice8o-uuYdAB"></script>
</head>

<body>
    @include('components.navbar-member')

    <section class="py-10 bg-gray-50 min-h-screen mt-20">
        <div class="max-w-4xl mx-auto px-4">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">
                Riwayat Pemesanan Anda
            </h2>

            @forelse($orders as $order)
                <div id="order-{{ $order->id }}"
                    class="bg-white shadow-md rounded-xl mb-6 overflow-hidden border border-gray-200 transition-transform transform hover:-translate-y-1 hover:shadow-lg">

                    {{-- Header --}}
                    <div class="bg-green-600 text-white px-6 py-3 flex justify-between items-center">
                        <h3 class="font-semibold text-lg">Pesanan {{ $order->resi }}</h3>
                        <p class="text-sm opacity-90">Tanggal: {{ $order->created_at->format('d M Y') }}</p>
                    </div>

                    {{-- Body --}}
                    <div class="px-6 py-4 space-y-3 text-gray-700">
                        <p><strong>Nomor Resi:</strong> EC{{ $order->resi }}</p>
                        <p><strong>Penjemputan:</strong> {{ $order->pickup_address }}</p>
                        <p><strong>Tujuan:</strong> {{ $order->destination_address }}</p>
                        <p><strong>Armada:</strong> {{ $order->vehicle == 'mobil' ? 'Mobil Listrik' : 'Motor Listrik' }}
                        </p>
                        <p><strong>Biaya:</strong> Rp {{ number_format($order->price, 0, ',', '.') }}</p>
                        <p><strong>Status:</strong>
                            <span
                                class="@if (strtolower($order->status) === 'selesai') text-green-600 
                                @elseif(strtolower($order->status) === 'proses') text-yellow-500 
                                @else text-gray-500 @endif font-medium"
                                id="status-{{ $order->id }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </p>
                    </div>

                    {{-- Footer --}}
                    <div class="px-6 py-3 bg-gray-50 flex justify-end gap-3 card-footer">
                        {{-- Tombol Bayar --}}
                        @if ($order->status == 'pending')
                            <button onclick="payNow('{{ $order->id }}')"
                                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                                <i class="fa fa-credit-card mr-2"></i> Bayar
                            </button>
                        @endif

                        {{-- Tombol Hapus --}}
                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST"
                            onsubmit="return confirm('Yakin hapus pesanan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                                <i class="fa fa-trash mr-2"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <p class="text-gray-500 text-lg">Belum ada riwayat pemesanan.</p>
                </div>
            @endforelse
        </div>
    </section>

    @include('components.footer')

    <script>
        function payNow(orderId) {
            fetch(`/payment/token/${orderId}`)
                .then(res => res.json())
                .then(data => {
                    if (!data.token) return alert(data.error || 'Token pembayaran tidak tersedia.');

                    snap.pay(data.token, {
                        onSuccess: function(result) {
                            alert('Pembayaran berhasil!');

                            // Update UI status
                            const statusEl = document.getElementById(`status-${orderId}`);
                            if (statusEl) {
                                statusEl.textContent = 'Proses';
                                statusEl.classList.remove('text-gray-500', 'text-yellow-500');
                                statusEl.classList.add('text-yellow-500');
                            }

                            // Sembunyikan tombol bayar
                            const orderCard = document.getElementById(`order-${orderId}`);
                            const payButton = orderCard.querySelector('button[onclick^="payNow"]');
                            if (payButton) payButton.style.display = 'none';

                            // Panggil endpoint callback (opsional)
                            fetch('/payment/callback', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    order_id: orderId,
                                    result
                                })
                            });
                        },
                        onPending: function(result) {
                            alert('Menunggu pembayaran...');
                        },
                        onError: function(result) {
                            alert('Pembayaran gagal!');
                        },
                        onClose: function() {
                            alert('Anda menutup popup pembayaran.');
                        }
                    });
                });
        }

        // Auto buka pembayaran untuk order pertama yang pending
        document.addEventListener('DOMContentLoaded', function() {
            @foreach ($orders as $order)
                @if ($order->status == 'pending')
                    payNow('{{ $order->id }}');
                    return;
                @endif
            @endforeach
        });
    </script>
</body>

</html>
