<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecosend | Dampak Hijau</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gradient-to-r from-green-50 via-white to-green-50 min-h-screen">
    {{-- Navbar --}}
    @include('components.navbar')

    {{-- === KONTEN UTAMA === --}}
    <main>
        <section
            class="relative py-16 px-6 md:px-12 lg:px-24 overflow-hidden">
            <div class="max-w-6xl mx-auto">
                <!-- Judul -->
                <h1 class="text-3xl md:text-4xl font-extrabold text-green-700 text-center mb-12 mt-20">
                    Dampak <span class="text-green-600">Hijau</span>
                </h1>

                <!-- Konten -->
                <div class="grid md:grid-cols-2 items-center gap-10">
                    <!-- Gambar -->
                    <div class="flex justify-center">
                        <img src="{{ asset('images/dampak-hijau.jpg') }}" alt="Dampak Hijau"
                            class="rounded-2xl shadow-lg w-4/5 md:w-full max-w-md hover:scale-105 transition-transform duration-500" />
                    </div>

                    <!-- Teks -->
                    <div class="text-gray-700 leading-relaxed text-justify">
                        <p class="mb-4">
                            <b class="text-green-700">ECOSEND</b> membantu mengurangi emisi karbon dari aktivitas
                            pengiriman barang.
                            Berdasarkan penelitian, kendaraan listrik dapat menekan emisi CO₂ hingga
                            <strong class="text-green-600">3–5 kali lebih rendah</strong> dibanding kendaraan berbahan
                            bakar minyak.
                        </p>
                        <p>
                            Selain ramah lingkungan, kendaraan listrik tidak hanya lebih efisien secara energi dan hemat
                            biaya
                            operasional, tetapi juga berkontribusi langsung pada
                            <span class="font-semibold text-green-700">kualitas udara yang lebih bersih</span> dan masa
                            depan
                            transportasi berkelanjutan di Indonesia.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Dekorasi Daun di pojok kanan bawah -->
            <div class="absolute bottom-8 right-8 opacity-10 md:opacity-20">
                <img src="{{ asset('images/leaf-icon.png') }}" alt="Daun Hijau" class="w-24 md:w-32 select-none" />
            </div>
        </section>
    </main>


    {{-- Footer --}}
    @include('components.footer')
</body>

</html>