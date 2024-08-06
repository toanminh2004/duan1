@extends('welcome')

@section('title')
    Giỏ hàng
@endsection

@section('content')
    <title>MingShop - Giỏ Hàng</title>
    <style>
        .ui-w-40 {
            width: 40px !important;
            height: auto;
        }

        .card {
            box-shadow: 0 1px 15px 1px rgba(52, 40, 104, .08);
        }

        .ui-product-color {
            display: inline-block;
            overflow: hidden;
            margin: .144em;
            width: .875rem;
            height: .875rem;
            border-radius: 10rem;
            -webkit-box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.15) inset;
            box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.15) inset;
            vertical-align: middle;
        }

        .float-right {
            float: right;
        }

        th.text-right.py-3[style="width: 100px;"],
        td.text-right.font-weight-semibold.align-middle.p-4[style="width: 100px;"] {
            white-space: nowrap;
        }

        .delete_all_class {
            text-decoration: none;
            color: red;
        }

        .delete_all_class:hover {
            text-decoration: underline;
            color: red;
        }

        .pro_name {
            text-decoration: none;
        }

        .pro_name:hover {
            text-decoration: underline;
        }
    </style>

    <div class="container p-0 my-5 clearfix"
        style="background-image: linear-gradient(to right, #0E2241 , #00b3ff); border-radius: 10px; box-shadow: 0px 0px 5px gainsboro;">

        <div class="card">
            <div class="card-header"
                style="background-image: linear-gradient(to right, #0E2241 , #00b3ff);
        color: white;">
                <p class="m-0 pt-2 pb-2" style="font-family: 'Tahoma'; font-weight: bold; font-size: x-large;">
                    Giỏ Hàng Của Bạn</p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered mb-5">
                        <thead>
                            <tr class="text-center">
                                <th class="text-center py-3" style="min-width: 400px;">Sản Phẩm & Chi Tiết</th>
                                <th class="text-right py-3" style="width: 100px;">Giá</th>
                                <th class="text-center py-3" style="width: 120px;">Số Lượng</th>
                                <th class="text-right py-3" style="width: 100px;">Tổng Tiền</th>
                                <th class="text-center py-3" style="width: 100px;">Xóa </th>
                            </tr>
                        </thead>

                        @foreach ($products as $pro)
                            <tbody>
                                <tr>
                                    <td class="p-4">
                                        <div class="media align-items-center d-flex">
                                            <a href=" {{ route('product.show', $pro->product_id) }} "><img
                                                    src="{{ Storage::url($pro->product_image) }}"
                                                    class="ui-w-40 ui-bordered me-4" alt="..."></a>
                                            <div class="media-body">
                                                <a href=" {{ route('product.show', $pro->product_id) }} "
                                                    class="pro_name d-block text-dark">
                                                    {{ $pro->product_name }}
                                                </a>
                                                <small>
                                                    <span class="text-muted"><strong>Danh mục</strong>:
                                                        {{ $pro->category_name }}</span>
                                                </small>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="text-right font-weight-semibold align-middle p-4" id="price">
                                        {{ $pro->product_price *((100 - $pro->sale_percent)/100) }}đ</td>

                                    <td class="align-middle">
                                        <form action="{{ route('cart.update') }}" method="POST">
                                            @csrf
                                            <div class="d-flex">
                                                <input type="hidden" name="cart_id" value="{{ $pro->cart_id }}">
                                                <input type="hidden" name="product_id" value="{{ $pro->product_id }}">
                                                <input type="number" name="quantity" value="{{ $pro->quantity }}" min="1" 
                                                class="form-control text-center" style="width: 50px">
                                                <div class="d-flex flex-column gap-2">
                                                    <button type="submit" name="quantity" value="{{ $pro->quantity + 1 }}" 
                                                        class="btn btn-primary">+</button>
                                                    @if ($pro->quantity >1)
                                                    <button type="submit" name="quantity" value="{{ $pro->quantity - 1 }}" 
                                                        class="btn btn-secondary" >-</button>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                        </form>
                                    </td>
                                    <td class="text-right font-weight-semibold align-middle p-4">
                                        {{ $pro->product_price *((100 - $pro->sale_percent)/100) * $pro->quantity }}đ</td>
                                    <td class="text-center align-middle px-0">
                                        <form action="{{ route('cart.delete') }}" method="post" style="font-size: xx-large;">
                                            @csrf
                                            <input value="{{ $pro->product_id }}" type="hidden" name="product_id" id="">
                                            <input value="{{ $cart->cart_id }}" type="hidden" name="cart_id" id="">
                                            <button type="submit" class="shop-tooltip close float-none text-danger text-decoration-none"
                                            onclick="return confirm('bạn có muốn xóa không');">x</button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
{{--    Hiển thị thông báo thành công--}}
    @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif

    {{--    Hiển thị thông báo lỗi--}}
    @if(session('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
    @endif
                    </table>
                </div>
                <div class="d-flex flex-wrap justify-content-between align-items-center pb-4  mt-2">
                    <div class="mt-4">
                    </div>
                    <div class="d-flex">

                        <div class="text-right mt-4">
                            <label class="text-muted font-weight-normal m-0">Tổng Thanh Toán</label>
                            <div class="text-large" style="color: red;"><strong>
                                    @php
                                        $totalPrice = 0;
                                        foreach ($products as $pro) {
                                            $totalPrice += $pro->product_price *((100 - $pro->sale_percent)/100) * $pro->quantity;
                                        }
                                        echo $totalPrice;
                                    @endphp
                                    đ
                                </strong>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="float-right">
                    

                    <form class="form-submit" action="{{ route('bill.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="cart_id" value="{{ $cart->cart_id }}">
                        <button type="submit" class="btn btn-lg btn-default md-btn-flat"
                        >Thanh Toán</button>
                    </form>

                </div>

                <div class="float-left"><a href="/"><input type="submit" class="btn btn-lg btn-default md-btn-flat"
                    value="Quay Lại"></input></a></div>
            </div>
        </div>
    </div>
@endsection
