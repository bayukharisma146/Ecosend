<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Riwayat Pemesanan - ECOSEND</title>

  <link rel="stylesheet" href="{{ asset('css/style-member.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/history.css') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>

<body>
  @include('components.navbar-member')

  <section class="history-section">
    <div class="container">
      <h2>Riwayat Pemesanan Anda</h2>

      <!-- Contoh Kartu 1 -->
      <div class="history-card" id="card-1">
        <div class="card-header">
          <h3>Pesanan #EC12345</h3>
          <p class="date">Tanggal: 23 Oktober 2025</p>
        </div>

        <div class="card-body">
          <p><i class="fa fa-location-dot"></i> <strong>Penjemputan:</strong> Jl. Malioboro No.10, Yogyakarta</p>
          <p><i class="fa fa-location-arrow"></i> <strong>Tujuan:</strong> Jl. Sudirman No.22, Sleman</p>
          <p><i class="fa fa-car"></i> <strong>Armada:</strong> Mobil Listrik</p>
          <p><i class="fa fa-wallet"></i> <strong>Biaya:</strong> Rp 45.000</p>
          <p><i class="fa fa-circle-check"></i> <strong>Status:</strong> <span class="status selesai">Selesai</span></p>
        </div>

        <div class="card-footer no-capture">
          <button class="btn-download" onclick="downloadImage('card-1')">
            <i class="fa fa-image"></i> Unduh Gambar
          </button>
          <button class="btn-download" onclick="downloadPDF('card-1')">
            <i class="fa fa-file-pdf"></i> Unduh PDF
          </button>
        </div>
      </div>

      <!-- Contoh Kartu 2 -->
      <div class="history-card" id="card-2">
        <div class="card-header">
          <h3>Pesanan #EC67890</h3>
          <p class="date">Tanggal: 22 Oktober 2025</p>
        </div>

        <div class="card-body">
          <p><i class="fa fa-location-dot"></i> <strong>Penjemputan:</strong> Jl. Parangtritis No.20, Bantul</p>
          <p><i class="fa fa-location-arrow"></i> <strong>Tujuan:</strong> Jl. Kaliurang No.88, Sleman</p>
          <p><i class="fa fa-car"></i> <strong>Armada:</strong> Motor Listrik</p>
          <p><i class="fa fa-wallet"></i> <strong>Biaya:</strong> Rp 25.000</p>
          <p><i class="fa fa-circle-check"></i> <strong>Status:</strong> <span class="status proses">Proses</span></p>
        </div>

        <div class="card-footer no-capture">
          <button class="btn-download" onclick="downloadImage('card-2')">
            <i class="fa fa-image"></i> Unduh Gambar
          </button>
          <button class="btn-download" onclick="downloadPDF('card-2')">
            <i class="fa fa-file-pdf"></i> Unduh PDF
          </button>
        </div>
      </div>
    </div>
  </section>

  @include('components.footer')

  <script>
    function downloadImage(cardId) {
      const card = document.getElementById(cardId);
      const footer = card.querySelector(".card-footer");
      footer.style.visibility = "hidden";

      html2canvas(card).then(canvas => {
        footer.style.visibility = "visible";
        const link = document.createElement("a");
        link.download = `${cardId}.png`;
        link.href = canvas.toDataURL("image/png");
        link.click();
      });
    }

    function downloadPDF(cardId) {
      const { jsPDF } = window.jspdf;
      const card = document.getElementById(cardId);
      const footer = card.querySelector(".card-footer");
      footer.style.visibility = "hidden";

      html2canvas(card).then(canvas => {
        footer.style.visibility = "visible";
        const pdf = new jsPDF("p", "mm", "a4");
        const imgData = canvas.toDataURL("image/png");
        const imgWidth = 190;
        const imgHeight = (canvas.height * imgWidth) / canvas.width;
        pdf.addImage(imgData, "PNG", 10, 10, imgWidth, imgHeight);
        pdf.save(`${cardId}.pdf`);
      });
    }
  </script>
</body>
</html>
