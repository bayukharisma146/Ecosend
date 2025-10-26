<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecosend | Beranda</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="font-[Poppins] text-gray-800 overflow-x-hidden">


    {{-- Navbar --}}
    @include('components.navbar')

    <!-- HERO SECTION -->
    <section class="relative h-[90vh] md:h-screen flex items-center justify-start">
        <!-- Background Image -->
        <div class="absolute inset-0 bg-cover bg-center"
            style="background-image: url('{{ asset('images/hero-bg.jpg') }}');"></div>

        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-white via-white/70 to-transparent"></div>

        <!-- Content -->
        <div class="relative z-20 px-6 md:pl-[8%] max-w-[700px] text-left">
            <h1
                class="font-[Merriweather] text-4xl sm:text-5xl md:text-6xl font-extrabold text-green-800 leading-tight mb-4">
                Green Delivery for a<br class="hidden sm:block">Better Tomorrow
            </h1>
            <p class="text-lg sm:text-xl text-green-600 mb-6 sm:mb-8">
                Gaya Hidup Cerdas: Ramah Lingkungan, Hemat, dan Efisien
            </p>
            <a href="/login"
                class="inline-block bg-white text-green-800 border-2 border-green-800 px-6 sm:px-8 py-2 sm:py-3 rounded-lg font-semibold shadow-md hover:bg-green-800 hover:text-white transition-all duration-300">
                Pesan Sekarang
            </a>
        </div>
    </section>


    <!-- === TENTANG ECOSEND SECTION === -->
    <section class="relative bg-white py-16 px-6 md:px-12 lg:px-24 overflow-hidden">
        <!-- Judul -->
        <h2 class="text-3xl md:text-4xl font-extrabold text-center text-green-700 mb-12">
            Tentang <span class="text-green-600">ECOSEND</span>
        </h2>
        
        <!-- Konten utama -->
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 items-center gap-10 md:gap-16">
            <!-- Gambar Peta -->
            <div class="flex justify-center">
                <img src="{{ asset('images/peta.PNG') }}" alt="Peta ECOSEND"
                    class="rounded-2xl shadow-md w-4/5 sm:w-3/4 md:w-full max-w-sm hover:scale-105 transition-transform duration-500" />
            </div>

            <!-- Teks -->
            <div class="text-gray-700 leading-relaxed text-sm sm:text-base md:text-lg">
                <p class="mb-6">
                    ECOSEND adalah platform pengiriman berbasis kendaraan listrik pertama di Yogyakarta yang
                    berkomitmen menghadirkan solusi logistik ramah lingkungan dan efisien.
                </p>

                <h3 class="text-lg md:text-xl font-bold text-green-700 mb-2">Visi</h3>
                <p class="mb-6">
                    Menjadi perusahaan pengiriman listrik terdepan di Indonesia yang mengedepankan keberlanjutan
                    dan efisiensi energi.
                </p>

                <h3 class="text-lg md:text-xl font-bold text-green-700 mb-2">Misi</h3>
                <ul class="list-disc list-inside space-y-2">
                    <li>Mengoperasikan 100% armada listrik</li>
                    <li>Memberikan layanan cepat dan aman</li>
                    <li>Mengurangi emisi CO₂ di sektor logistik</li>
                </ul>
            </div>
        </div>

        <!-- Dekorasi gambar bumi -->
        <div class="absolute bottom-8 right-8 opacity-20 md:opacity-40">
            <img src="{{ asset('images/earth-icon.png') }}" alt="Bumi Hijau" class="w-32 md:w-44 lg:w-56 select-none" />
        </div>
    </section>


    {{-- Footer --}}
    @include('components.footer')

</body>

</html>