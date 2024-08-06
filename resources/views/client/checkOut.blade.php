@extends('welcome')

@section('title')
    Trang thanh toán
@endsection

@section('content')
    

<main id="main" role="main">
    <section id="checkout-container">
        <div class="container">
            <div class="py-5 text-center">
                <i class="fa fa-credit-card fa-3x text-primary"></i>
                <h2 class="my-3">Thanh Toán Đơn Hàng</h2>
            </div>
            <div class="row mb-5">
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Giỏ Hàng Của Bạn</span>
                    </h4>
                    <ul class="list-group mb-3">
                        @foreach ($products as $pro)
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Tên Sản Phẩm</h6>
                                <small class="text-muted">{{ $pro->product_name }}</small>
                                <h6 class="my-0">Loại</h6>
                                <small class="text-muted">{{ $pro->category_name }}</small>
                                <h6 class="my-0">Số Lượng</h6>
                                <small class="text-muted">{{ $pro->quantity }}</small>
                            </div>
                            <span class="text-muted">{{ $pro->quantity*$pro->product_price *((100 - $pro->sale_percent)/100) }}đ</span>
                        </li>
                        @endforeach

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Tổng tiền =</span>
                            <strong>
                                @php
                                $totalPrice = 0;
                                        foreach ($carts as $cart) {
                                            $totalPrice += $cart->product_price *((100 - $cart->sale_percent)/100)*$cart->quantity;
                                        }
                                        echo $totalPrice;
                                @endphp
                            đ</strong>
                        </li>

                    </ul>
                </div>
                <form action="{{ route('pay') }}" class="col-md-8 order-md-1" method="POST">
                    @csrf
                    <h4 class="mb-3">Thông Tin</h4>
                        <div class="mb-3">
                            <label for="email">Họ tên
                            </label>
                            <input type="text" class="form-control" name="name" 
                            placeholder="{{ Auth::user()->name }}" id="tel">
                        </div>

                        <div class="mb-3">
                            <label for="email">Số Điện Thoại
                            </label>
                            <input type="text" class="form-control" name="phone" 
                            placeholder="{{ Auth::user()->phone }}" id="tel">
                        </div>

                        <div class="mb-3">
                            <label for="email">Email
                            </label>
                            <input type="text" class="form-control" name="email" 
                            placeholder="{{ Auth::user()->email }}" id="tel">
                        </div>

                        <div class="mb-3">
                            <label for="address">Địa Chỉ</label>
                            <input type="text" class="form-control" name="address"
                             placeholder="{{ Auth::user()->address }}">
                        </div>
                        <hr>


                        <h4 class="mb-3">Phương Thức Thanh Toán</h4>
                        <hr>
                            <input type="hidden" name="id" value="{{ $bill->id }}">
                            <button class="btn btn-primary btn-lg btn-block" name="pay"
                             type="submit" >Thanh Toán COD</button>
                        
                
                </form>
            </div>
        </div>

    </section>
@endsection