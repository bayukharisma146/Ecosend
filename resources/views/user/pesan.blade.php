<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Pengiriman | Ecosend</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-gradient-to-br from-green-50 to-white">
    @include('components.navbar-member')

    <section class="py-16 ">
        <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-10 items-center">

            <!-- Kiri -->
            <div class="space-y-6 mt-20">
                <h2 class="text-3xl md:text-4xl font-bold text-green-800">
                    Pesan Pengiriman Anda <span class="text-green-600">Sekarang</span>
                </h2>

                <!-- Form -->
                <form id="order-form" action="{{ route('user.storePesan') }}" method="POST" class="space-y-5">
                    @csrf

                    <!-- Alamat Penjemputan -->
                    <div class="relative">
                        <i class="fa-solid fa-location-dot absolute left-4 top-3.5 text-green-600"></i>
                        <input type="text" name="pickup_address" placeholder="Alamat Penjemputan" required
                            class="w-full pl-10 pr-4 py-3 rounded-lg border border-green-300 focus:ring-2 focus:ring-green-600 focus:outline-none">
                    </div>

                    <!-- Alamat Tujuan -->
                    <div class="relative">
                        <i class="fa-solid fa-location-arrow absolute left-4 top-3.5 text-green-600"></i>
                        <input type="text" name="destination_address" placeholder="Alamat Tujuan" required
                            class="w-full pl-10 pr-4 py-3 rounded-lg border border-green-300 focus:ring-2 focus:ring-green-600 focus:outline-none">
                    </div>

                    <!-- Jenis Kendaraan -->
                    <div class="relative">
                        <i class="fa-solid fa-truck absolute left-4 top-3.5 text-green-600"></i>
                        <select name="vehicle" required
                            class="w-full pl-10 pr-4 py-3 rounded-lg border border-green-300 bg-white text-gray-700 focus:ring-2 focus:ring-green-600 focus:outline-none">
                            <option value="motor">Motor Listrik</option>
                            <option value="mobil">Mobil Listrik</option>
                        </select>
                    </div>

                    <!-- Waktu -->
                    <div class="relative">
                        <i class="fa-solid fa-clock absolute left-4 top-3.5 text-green-600"></i>
                        <select name="time" required
                            class="w-full pl-10 pr-4 py-3 rounded-lg border border-green-300 bg-white text-gray-700 focus:ring-2 focus:ring-green-600 focus:outline-none">
                            <option value="sekarang">Sekarang</option>
                        </select>
                    </div>

                    <!-- Estimasi Biaya -->
                    <div class="text-center bg-green-50 rounded-lg py-4">
                        <p class="text-green-700 font-medium">Estimasi Biaya</p>
                        <h3 id="price" class="text-2xl font-bold text-green-800">-</h3>
                    </div>

                    <!-- Tombol -->
                    <button type="submit"
                        class="w-full bg-green-700 hover:bg-green-800 text-white py-3 rounded-lg font-semibold transition-colors duration-300">
                        PESAN SEKARANG
                    </button>
                </form>
            </div>

            <!-- Kanan -->
            <div class="flex justify-center md:justify-end">
                <img src="{{ asset('images/mobil-listrik.png') }}" alt="Mobil Listrik Ecosend"
                    class="w-72 md:w-96 drop-shadow-xl">
            </div>
        </div>
    </section>

    @include('components.footer')

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('input[name="pickup_address"], input[name="destination_address"]').on('input', function () {
                let pickup = $('input[name="pickup_address"]').val();
                let destination = $('input[name="destination_address"]').val();

                if (pickup && destination) {
                    $.ajax({
                        url: "{{ route('user.estimatePrice') }}",
                        method: "GET",
                        data: { pickup: pickup, destination: destination },
                        success: function (response) {
                            if (response.success) {
                                $('#price').text('Rp ' + response.price);
                            } else {
                                $('#price').text('-');
                            }
                        },
                        error: function () {
                            $('#price').text('-');
                        }
                    });
                } else {
                    $('#price').text('-');
                }
            });
        });
    </script>
</body>

</html>