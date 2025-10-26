<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Riwayat Pemesanan - ECOSEND</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>

<body>
  @include('components.navbar-member')

  <section class="py-10 bg-gray-50 min-h-screen mt-20">
    <div class="max-w-4xl mx-auto px-4">
      <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">
        Riwayat Pemesanan Anda
      </h2>

      @forelse($orders as $order)
        <div
          class="bg-white shadow-md rounded-xl mb-6 overflow-hidden border border-gray-200 transition-transform transform hover:-translate-y-1 hover:shadow-lg">
          {{-- Header --}}
          <div class="bg-green-600 text-white px-6 py-3 flex justify-between items-center">
            <h3 class="font-semibold text-lg">Pesanan #EC{{ $order->id }}</h3>
            <p class="text-sm opacity-90">Tanggal: {{ $order->created_at->format('d M Y') }}</p>
          </div>

          {{-- Body --}}
          <div class="px-6 py-4 space-y-3 text-gray-700">
            <p class="flex items-center gap-2">
              <i class="fa fa-barcode text-green-600"></i>
              <strong>Nomor Resi:</strong>
              <span>EC{{ $order->id }}</span>
            </p>

            <p class="flex items-center gap-2">
              <i class="fa fa-location-dot text-green-600"></i>
              <strong>Penjemputan:</strong>
              <span>{{ $order->pickup_address }}</span>
            </p>

            <p class="flex items-center gap-2">
              <i class="fa fa-location-arrow text-green-600"></i>
              <strong>Tujuan:</strong>
              <span>{{ $order->destination_address }}</span>
            </p>

            <p class="flex items-center gap-2">
              <i class="fa fa-car text-green-600"></i>
              <strong>Armada:</strong>
              <span>{{ $order->vehicle == 'mobil' ? 'Mobil Listrik' : 'Motor Listrik' }}</span>
            </p>

            <p class="flex items-center gap-2">
              <i class="fa fa-wallet text-green-600"></i>
              <strong>Biaya:</strong>
              <span>Rp {{ number_format($order->price, 0, ',', '.') }}</span>
            </p>

            <p class="flex items-center gap-2">
              <i class="fa fa-circle-check text-green-600"></i>
              <strong>Status:</strong>
              <span class="@if(strtolower($order->status) === 'selesai') text-green-600 
              @elseif(strtolower($order->status) === 'proses') text-yellow-500 
                          @else text-gray-500 @endif font-medium">
                {{ ucfirst($order->status) }}
              </span>
            </p>
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