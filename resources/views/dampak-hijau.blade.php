    <!DOCTYPE html>
    <html lang="id">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecosend | Dampak Hijau</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dampak-hijau.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    </head>
    <body>
    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Konten Utama --}}
    <main class="content" style="margin-top: 10px;">
        <section class="green-impact">
        <div class="container">
            <h1 class="impact-title">Dampak Hijau</h1>
            <div class="impact-content">
            <div class="impact-image">
                <img src="{{ asset('images/dampak-hijau.jpg') }}" alt="Dampak Hijau">
            </div>
            <div class="impact-text">
                <p>
                <b>ECOSEND</b> membantu mengurangi emisi karbon dari aktivitas pengiriman barang. Berdasarkan penelitian, kendaraan listrik dapat menekan emisi CO₂ 
                hingga <strong>3–5 kali lebih rendah dibanding kendaraan berbahan bakar minyak</strong>.
                Selain ramah lingkungan, kendaraan listrik lebih efisien secara energi dan hemat biaya operasional,
                tetapi juga berkontribusi langsung pada kualitas udara yang lebih bersih dan masa depan transportasi berkelanjutan di Indonesia.
                </p>
            </div>
            </div>
        </div>
        </section>
    </main>

    {{-- Footer --}}
    @include('components.footer')
    </body>
    </html>
