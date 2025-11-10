<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | ECOSEND</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.6s ease-in-out;
        }

        ::-webkit-scrollbar {
            height: 8px;
            width: 6px;
        }

        ::-webkit-scrollbar-thumb {
            background: #16a34a;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f3f4f6;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-green-50 to-white min-h-screen text-gray-700">

    <!-- HEADER -->
    <header class="fixed top-0 left-0 right-0 bg-white/80 backdrop-blur-md shadow-sm z-50">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between px-6 py-4 gap-3">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-leaf text-green-600 text-2xl"></i>
                <h1 class="text-xl font-bold text-green-700">ECOSEND Admin</h1>
            </div>

            <!-- Bagian kanan: Pencarian + Halo + Profil -->
            <div class="flex items-center gap-4 flex-wrap justify-end">
                <!-- Kolom pencarian -->
                <div class="relative">
                    <i class="fa fa-search text-green-600 absolute left-3 top-2.5"></i>
                    <input id="searchInput" type="text" placeholder="Cari pesanan..."
                        class="pl-9 pr-3 py-2 border border-green-300 rounded-full focus:outline-none focus:ring-2 focus:ring-green-400 text-sm w-52 sm:w-64 md:w-72 transition">
                </div>

                <!-- Halo dan profil -->
                <div class="flex items-center gap-2">
                    <span class="text-sm font-medium text-gray-600">Halo, Admin 👋</span>
                    <img src="https://ui-avatars.com/api/?name=Admin&background=16a34a&color=fff" alt="admin"
                        class="w-9 h-9 rounded-full shadow-md">
                </div>
            </div>

    </header>

    <!-- MAIN -->
    <main class="px-6 py-10 mt-28 max-w-7xl mx-auto fade-in">

        <!-- STATISTIC CARDS -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
            <div
                class="bg-white border border-green-100 shadow-md hover:shadow-lg transition rounded-2xl p-6 flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Pesanan</p>
                    <h3 class="text-3xl font-bold text-green-700">{{ $orders->count() }}</h3>
                </div>
                <i class="fa-solid fa-box-open text-4xl text-green-600 opacity-70"></i>
            </div>

            <div
                class="bg-white border border-green-100 shadow-md hover:shadow-lg transition rounded-2xl p-6 flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Selesai</p>
                    <h3 class="text-3xl font-bold text-green-700">{{ $orders->where('status', 'selesai')->count() }}
                    </h3>
                </div>
                <i class="fa-solid fa-circle-check text-4xl text-green-600 opacity-70"></i>
            </div>

            <div
                class="bg-white border border-green-100 shadow-md hover:shadow-lg transition rounded-2xl p-6 flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Dalam Proses</p>
                    <h3 class="text-3xl font-bold text-green-700">
                        {{ $orders->where('status', '!=', 'selesai')->count() }}</h3>
                </div>
                <i class="fa-solid fa-truck-fast text-4xl text-green-600 opacity-70"></i>
            </div>
        </div>

        <!-- TABEL -->
        <section class="overflow-x-auto bg-white shadow-lg border border-gray-100 rounded-2xl">
            <table class="min-w-full text-sm">
                <thead class="bg-green-600 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left">Resi</th>
                        <th class="py-3 px-4 text-left">Nama User</th>
                        <th class="py-3 px-4 text-left">Nomor WA</th>
                        <th class="py-3 px-4 text-left">Pickup</th>
                        <th class="py-3 px-4 text-left">Tujuan</th>
                        <th class="py-3 px-4 text-left">Armada</th>
                        <th class="py-3 px-4 text-left">Status</th>
                        <th class="py-3 px-4 text-right">Harga</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="orderTable">
                    @forelse ($orders as $order)
                        <tr class="border-t hover:bg-green-50 transition duration-200">
                            <td class="py-3 px-4 font-semibold text-green-700">{{ $order->resi }}</td>
                            <td class="py-3 px-4">{{ $order->user->name ?? '-' }}</td>
                            <td class="py-3 px-4">
                                @if ($order->phone)
                                    <a href="https://wa.me/{{ preg_replace('/^0/', '62', $order->phone) }}"
                                        target="_blank"
                                        class="text-green-600 hover:text-green-700 flex items-center gap-2">
                                        <i class="fa-brands fa-whatsapp text-lg"></i> {{ $order->phone }}
                                    </a>
                                @else
                                    <span class="text-gray-400 italic">Belum ada</span>
                                @endif
                            </td>
                            <td class="py-3 px-4">{{ Str::limit($order->pickup_address, 20) }}</td>
                            <td class="py-3 px-4">{{ Str::limit($order->destination_address, 20) }}</td>
                            <td class="py-3 px-4 capitalize">{{ $order->vehicle }}</td>

                            <td class="py-3 px-4">
                                <select data-id="{{ $order->id }}"
                                    class="status-dropdown border border-green-300 rounded-md px-2 py-1 text-sm focus:ring-2 focus:ring-green-400">
                                    <option value="proses" {{ $order->status == 'proses' ? 'selected' : '' }}>Proses
                                    </option>
                                    <option value="sedang di antar"
                                        {{ $order->status == 'sedang di antar' ? 'selected' : '' }}>Sedang di antar
                                    </option>
                                    <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai
                                    </option>
                                </select>
                            </td>

                            <td class="py-3 px-4 text-right font-semibold text-gray-800">
                                Rp{{ number_format($order->price, 0, ',', '.') }}
                            </td>

                            <td class="py-3 px-4 text-center">
                                @if ($order->phone)
                                    <a href="https://wa.me/{{ preg_replace('/^0/', '62', $order->phone) }}"
                                        target="_blank"
                                        class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-lg shadow transition-all transform hover:scale-105">
                                        <i class="fa-brands fa-whatsapp"></i> Chat
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="py-6 text-center text-gray-500 italic">Belum ada pesanan 😔</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </section>
    </main>

    <!-- FOOTER -->
    <footer class="mt-10 text-center text-gray-500 text-sm pb-6">
        © {{ date('Y') }} ECOSEND • <span class="text-green-600 font-medium">Fast • Eco • Reliable</span>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Update Status
            $('.status-dropdown').on('change', function() {
                let orderId = $(this).data('id');
                let status = $(this).val();

                $.ajax({
                    url: `/admin/update-status/${orderId}`,
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        status: status
                    },
                    success: function(res) {
                        if (res.success) {
                            const notif = $(
                                '<div class="fixed top-6 right-6 bg-green-600 text-white px-4 py-2 rounded-lg shadow-lg fade-in">✅ Status berhasil diperbarui!</div>'
                            );
                            $('body').append(notif);
                            setTimeout(() => notif.fadeOut(500, () => notif.remove()), 2000);
                        }
                    },
                    error: function() {
                        const notif = $(
                            '<div class="fixed top-6 right-6 bg-red-600 text-white px-4 py-2 rounded-lg shadow-lg fade-in">❌ Gagal memperbarui status!</div>'
                        );
                        $('body').append(notif);
                        setTimeout(() => notif.fadeOut(500, () => notif.remove()), 2000);
                    }
                });
            });

            // 🔍 Real-time search
            $('#searchInput').on('keyup', function() {
                let value = $(this).val().toLowerCase();
                $("#orderTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>
</body>

</html>
