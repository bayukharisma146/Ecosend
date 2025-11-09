<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin | ECOSEND</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-gray-50 min-h-screen">

  <section class="px-6 py-10 mt-20">
    <h1 class="text-3xl font-bold text-green-700 mb-8 text-center">Dashboard Admin - Data Pesanan</h1>

    <div class="overflow-x-auto bg-white shadow-md rounded-xl">
      <table class="min-w-full border border-gray-200 rounded-xl overflow-hidden">
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
        <tbody>
          @forelse ($orders as $order)
            <tr class="border-t hover:bg-gray-50">
              <td class="py-3 px-4 font-semibold text-green-700">{{ $order->resi }}</td>
              <td class="py-3 px-4">{{ $order->user->name ?? '-' }}</td>
              <td class="py-3 px-4">
                @if($order->phone)
                  <a href="https://wa.me/{{ preg_replace('/^0/', '62', $order->phone) }}" target="_blank"
                    class="text-green-600 hover:text-green-700 flex items-center gap-2">
                    <i class="fa-brands fa-whatsapp text-xl"></i> {{ $order->phone }}
                  </a>
                @else
                  <span class="text-gray-400 italic">Belum ada</span>
                @endif
              </td>
              <td class="py-3 px-4">{{ Str::limit($order->pickup_address, 20) }}</td>
              <td class="py-3 px-4">{{ Str::limit($order->destination_address, 20) }}</td>
              <td class="py-3 px-4 capitalize">{{ $order->vehicle }}</td>

              <td class="py-3 px-4">
                <select data-id="{{ $order->id }}" class="status-dropdown border rounded-md px-2 py-1 text-sm">
                    <option value="proses" {{ $order->status == 'proses' ? 'selected' : '' }}>Proses</option>
                    <option value="sedang di antar" {{ $order->status == 'sedang di antar' ? 'selected' : '' }}>Sedang di antar</option>
                    <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai</option>

                </select>
              </td>

              <td class="py-3 px-4 text-right">Rp{{ number_format($order->price, 0, ',', '.') }}</td>

              <td class="py-3 px-4 text-center">
                @if($order->phone)
                  <a href="https://wa.me/{{ preg_replace('/^0/', '62', $order->phone) }}" target="_blank"
                    class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-lg">
                    <i class="fa-brands fa-whatsapp"></i>
                  </a>
                @endif
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="9" class="py-6 text-center text-gray-500">Belum ada pesanan.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </section>

  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script>
    $(document).ready(function() {
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
              alert('✅ Status berhasil diperbarui!');
            }
          },
          error: function() {
            alert('❌ Gagal memperbarui status!');
          }
        });
      });
    });
  </script>
</body>

</html>
