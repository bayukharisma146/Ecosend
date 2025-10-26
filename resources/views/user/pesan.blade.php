<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pesan Pengiriman | Ecosend</title>
<link rel="stylesheet" href="{{ asset('css/style-member.css') }}">
<link rel="stylesheet" href="{{ asset('css/pesan.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
@include('components.navbar-member')

<section class="order-section">
<div class="order-container">
    <div class="order-left">
        <h2>Pesan Pengiriman Anda <span>Sekarang</span></h2>

        <form id="order-form" action="{{ route('user.storePesan') }}" method="POST">
            @csrf
            <div class="input-group">
                <i class="fa-solid fa-location-dot"></i>
                <input type="text" name="pickup_address" placeholder="Alamat Penjemputan" required>
            </div>

            <div class="input-group">
                <i class="fa-solid fa-location-arrow"></i>
                <input type="text" name="destination_address" placeholder="Alamat Tujuan" required>
            </div>

            <div class="input-group select-group">
                <i class="fa-solid fa-truck"></i>
                <select name="vehicle" required>
                    <option value="motor">Motor Listrik</option>
                    <option value="mobil">Mobil Listrik</option>
                </select>
            </div>

            <div class="input-group select-group">
                <i class="fa-solid fa-clock"></i>
                <select name="time" required>
                    <option value="sekarang">Sekarang</option>
                </select>
            </div>

            <div class="estimate">
                <p>Estimasi Biaya</p>
                <h3 id="price">-</h3>
            </div>

            <button type="submit" class="btn-order">PESAN SEKARANG</button>
        </form>
    </div>

    <div class="order-right">
        <img src="{{ asset('images/mobil-listrik.png') }}" alt="Mobil Listrik Ecosend">
    </div>
</div>
</section>

@include('components.footer')

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
$(document).ready(function() {
    $('input[name="pickup_address"], input[name="destination_address"]').on('input', function() {
        let pickup = $('input[name="pickup_address"]').val();
        let destination = $('input[name="destination_address"]').val();

        if(pickup && destination){
            $.ajax({
                url: "{{ route('user.estimatePrice') }}",
                method: "GET",
                data: { pickup: pickup, destination: destination },
                success: function(response){
                    if(response.success){
                        $('#price').text('Rp ' + response.price);
                    } else {
                        $('#price').text('-');
                    }
                },
                error: function(){
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
