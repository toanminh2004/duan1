@extends('welcome')

@section('title')
    Chính sách bảo hành
@endsection

@section('content')
<style>
    .warranty-image {
        max-width: 100%;
        height: auto;
    }
</style>
<div class="container my-5">
    <div class="row">
        <div class="col-12 text-center mb-4">
            <h1>Chính Sách Bảo Hành</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-4">
            <h2>Điều Kiện Bảo Hành</h2>
            <p>Sản phẩm được bảo hành miễn phí nếu thỏa mãn các điều kiện sau:</p>
            <ul>
                <li>Sản phẩm còn trong thời hạn bảo hành.</li>
                <li>Hư hỏng do lỗi kỹ thuật của nhà sản xuất.</li>
                <li>Có phiếu bảo hành và hóa đơn mua hàng hợp lệ.</li>
            </ul>
            <h2>Thời Gian Bảo Hành</h2>
            <p>Thời gian bảo hành là 12 tháng kể từ ngày mua hàng. Đối với các sản phẩm điện tử, thời gian bảo hành là 24 tháng.</p>
            <h2>Quy Trình Bảo Hành</h2>
            <ul>
                <li>Liên hệ với trung tâm bảo hành qua hotline: 0868403204.</li>
                <li>Đem sản phẩm đến trung tâm bảo hành gần nhất.</li>
                <li>Chờ xác nhận và xử lý từ trung tâm bảo hành.</li>
            </ul>
        </div>
        <div class="col-md-6 text-center">
            <img src="{{ asset('images/baohanh.webp') }}" alt="Chính sách bảo hành" class="warranty-image">
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center mt-4">
            <button class="btn btn-primary">Liên Hệ Ngay</button>
        </div>
    </div>
</div>
@endsection