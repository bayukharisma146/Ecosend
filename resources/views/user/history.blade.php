<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Riwayat Pemesanan - ECOSEND</title>

  <link rel="stylesheet" href="{{ asset('css/style-member.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/history.css') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>

<body>
  @include('components.navbar-member')

<section class="history-section">
<div class="container">
    <h2>Riwayat Pemesanan Anda</h2>

    @forelse($orders as $order)
    <div class="history-card">
        <div class="card-header">
            <h3>Pesanan #EC{{ $order->id }}</h3>
            <p class="date">Tanggal: {{ $order->created_at->format('d M Y') }}</p>
        </div>
        <div class="card-body">
            <p><i class="fa fa-barcode"></i> <strong>Nomor Resi:</strong> EC{{ $order->id }}</p>
            <p><i class="fa fa-location-dot"></i> <strong>Penjemputan:</strong> {{ $order->pickup_address }}</p>
            <p><i class="fa fa-location-arrow"></i> <strong>Tujuan:</strong> {{ $order->destination_address }}</p>
            <p><i class="fa fa-car"></i> <strong>Armada:</strong> {{ $order->vehicle == 'mobil' ? 'Mobil Listrik' : 'Motor Listrik' }}</p>
            <p><i class="fa fa-wallet"></i> <strong>Biaya:</strong> Rp {{ number_format($order->price, 0, ',', '.') }}</p>
            <p><i class="fa fa-circle-check"></i> <strong>Status:</strong> <span class="status {{ strtolower($order->status) }}">{{ $order->status }}</span></p>
        </div>
    </div>
    @empty
    <p>Belum ada riwayat pemesanan.</p>
    @endforelse
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
