@extends('welcome')

@section('title')
    Phương thức thanh toán
@endsection

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-12 text-center mb-4">
            <h1>Thanh toán COD là gì? Tìm hiểu về phương thức thanh toán COD tại MingShop</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-4">
            <h2>Quy trình thanh toán COD</h2>
            <p>
                Khi bạn chọn phương thức thanh toán COD, bạn sẽ được phép thanh toán sau khi
                 nhận được hàng. Theo đó, khi đặt hàng, bạn chỉ cần chọn phương thức thanh 
                 toán COD, sau đó chờ đợi đơn vị vận chuyển giao hàng tới địa chỉ của bạn.
                  Khi nhận được hàng, bạn sẽ trực tiếp thanh toán cho nhân viên giao hàng.
            </p>
            <h2>Cách thức nhận và trả hàng khi thanh toán COD</h2>
            <p>
                Khi bạn nhận được hàng, hãy kiểm tra kỹ trước khi trả tiền. Nếu hàng 
                hóa bị hư hỏng hoặc không đúng với mô tả, bạn có thể từ chối thanh 
                toán và trả lại hàng cho nhân viên giao hàng. Nếu bạn chấp nhận hàng, 
                hãy trả tiền mặt cho nhân viên giao hàng. Quá trình trả hàng và thanh
                 toán COD sẽ kết thúc khi nhân viên giao hàng xác nhận việc nhận tiền
                  và ký xác nhận trên biên nhận.
            </p>
        </div>
        <div class="col-md-6 text-center">
            <img src="{{ asset('images/pay1.jpg') }}" alt="COD Process" class="cod-image">
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center mt-4">
            <a href="/" class="btn btn-primary">Mua hàng ngay</a>
        </div>
    </div>
</div>
@endsection