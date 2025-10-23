    <!DOCTYPE html>
    <html lang="id">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecosend | Beranda</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/beranda.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    </head>
    <body>
    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Hero Section --}}
    <main style="margin-top: 130px;">  {{-- Tambahkan margin-top agar tidak tertutup navbar --}}
        <section class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Green Delivery for a Better Tomorrow</h1>
            <p>Gaya Hidup Cerdas: Ramah Lingkungan, Hemat, dan Efisien</p>
            <a href="/pesan" class="btn-hero">Pesan Sekarang</a>
        </div>

        <div class="hero-footer">
            <div class="info-item">
            <i class="fa-solid fa-phone"></i>
            <span>+123-456-7890</span>
            </div>
            <div class="info-item">
            <i class="fa-solid fa-location-dot"></i>
            <span>No. 10 Umbulharjo, Yogyakarta 55161</span>
            </div>
            <div class="info-item">
            <i class="fa-solid fa-globe"></i>
            <span>www.ecosend.my.id</span>
            </div>
        </div>
        </section>

        <!-- === TENTANG ECOSEND SECTION === -->
    <section class="about">
        <h2 class="about-title">Tentang <span>ECOSEND</span></h2>
        <div class="about-container">
        <div class="about-image">
            <img src="{{ asset('images/map.jpg') }}" alt="Peta ECOSEND">
        </div>
        <div class="about-text">
            <p>
            ECOSEND adalah platform pengiriman berbasis kendaraan listrik pertama di Yogyakarta yang berkomitmen menghadirkan solusi logistik ramah lingkungan dan efisien.
            </p>
            <h3>Visi</h3>
            <p>
            Menjadi perusahaan pengiriman listrik terdepan di Indonesia yang mengedepankan keberlanjutan dan efisiensi energi.
            </p>
            <h3>Misi</h3>
            <ul>
            <li>Mengoperasikan 100% armada listrik</li>
            <li>Memberikan layanan cepat dan aman</li>
            <li>Mengurangi emisi CO₂ di sektor logistik</li>
            </ul>
        </div>
        </div>
        <div class="about-decor">
        <img src="{{ asset('images/earth-icon.png') }}" alt="Bumi Hijau">
        </div>
        </section>
    </main>

    {{-- Footer --}}
    @include('components.footer')
    </body>
    </html>
