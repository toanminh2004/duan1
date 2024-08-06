@extends('welcome')

@section('title')
    Danh sách đơn hàng
@endsection

@section('content')

    <style>
        body {
            overflow-x: hidden;
            height: 100%;
            background-color: whitesmoke;
            background-repeat: no-repeat;
        }

        .card {
            z-index: 0;
            background-color: white;
            padding-bottom: 20px;
            margin-top: 90px;
            margin-bottom: 90px;
            border-radius: 10px;
        }

        /*Icon progressbar*/
        #progressbar {
            margin-bottom: 30px;
            overflow: hidden;
            color: #455A64;
            padding-left: 0px;
            margin-top: 30px;
        }

        #progressbar li {
            list-style-type: none;
            font-size: 13px;
            width: 300%;
            float: left;
            position: relative;
            font-weight: 400;
        }

        #progressbar .step0:before {
            font-family: FontAwesome;
            content: "\f10c";
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #progressbar li:before {
            width: 40px;
            height: 40px;
            line-height: 45px;
            display: block;
            font-size: 20px;
            background: #C5CAE9;
            border-radius: 50%;
            margin: auto;
            padding: 0px;
        }

        /*ProgressBar connectors*/
        #progressbar li:after {
            content: '';
            width: 100%;
            height: 12px;
            background: #C5CAE9;
            position: absolute;
            left: 0;
            top: 16px;
            z-index: -1;
        }

        #progressbar li:last-child:after {
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
            position: absolute;
            left: -50%;
        }

        #progressbar li:nth-child(2):after,
        #progressbar li:nth-child(3):after {
            left: -50%;
        }

        #progressbar li:first-child:after {
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
            position: absolute;
            left: 50%;
        }

        #progressbar li:last-child:after {
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        #progressbar li:first-child:after {
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }

        /*Color number of the step and the connector before it*/
        #progressbar li.active:before,
        #progressbar li.active:after {
            background: #651FFF;
        }

        #progressbar li.active:before {
            font-family: FontAwesome;
            content: "\f00c";
        }

        .icon {
            width: 60px;
            height: 60px;
            margin-right: 15px;
        }

        @media screen and (max-width: 992px) {
            .icon-content {
                width: 50%;
            }
        }

        .btn-cancel {
            background-color: orangered;
            color: white;
            padding: 5px;
            text-align: center;
            border-radius: 0p 5px 5px 0px;
            border: 1px solid red;
            box-shadow: 0px 0px 5px gainsboro;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-cancel:hover {
            background-color: #0E2241;
            border: 1px solid #0E2241;
            color: white;
        }

        .btn-cant-cancel {
            background-color: #00b3ff;
            color: white;
            padding: 5px;
            text-align: center;
            border-radius: 0p 5px 5px 0px;
            border: 1px solid #00b3ff;
            box-shadow: 0px 0px 5px gainsboro;
            font-weight: 600;
            transition: 0.3s;
        }


        .order-qty {
            color: orangered;
        }

        .order-btn {
            background-color: white;
            display: flex;
            justify-content: center;
            text-align: center;
            border: 1px solid black;
            box-shadow: 1px 1px 1px black;
            border-radius: 5px;
            padding: 5px 28px;
            font-weight: 600;
            transition: 0.3s;
        }

        .order-btn:hover {
            color: white;
            background-color: #00b3ff;
        }

        a {
            text-decoration: none;
        }
    </style>

    <div class="container my-5">
        <div class="row m-0 d-flex justify-content-center">
            <h2 class="col-12" style="text-align: center;">
                <i class="fas fa-box"></i> Các đơn hàng của bạn
                <strong class="order-qty"></strong>
            </h2>
        </div>
        @if ($products)
            @foreach ($billes as $bill)
                @if ($bill->status_id)
                    <div class="card m-0 p-0 mt-3" style="box-shadow: 0px 0px 3px gainsboro;">
                        <div class="row d-flex justify-content-between px-3 top pt-3">
                            <div class="col-6">
                                <h5>Mã Đơn Hàng: <span class="text-primary font-weight-bold">#
                                        {{ $bill->id }}

                                    </span></h5>
                                <p class="mb-0">Khách Hàng: <span>
                                        {{ $bill->name }}
                                    </span></p>
                                <p class="mb-0">Địa Chỉ: <span>
                                        {{ $bill->address }}
                                    </span></p>
                            </div>
                            <div class="col-6 d-flex flex-column" style="align-items: end;">
                                <h5>Sản Phẩm:<br>
                                    @foreach ($products as $pro)
                                        @if ($pro->bill_id == $bill->id)
                                            <span class="text-primary font-weight-bold">
                                                {{ $pro->product_name }}
                                                x{{ $pro->quantity }}</span><br>
                                        @endif
                                    @endforeach

                                </h5>
                                <p class="mb-0">Hình Thức Thanh Toán: <span>
                                        Thanh Toán COD
                                    </span></p>
                                <p class="mb-0">Tổng Thanh Toán: <span>
                                        @php
                                            $totalPrice = 0;
                                            foreach ($products as $pro) {
                                                if ($pro->bill_id == $bill->id) {
                                                    $totalPrice +=
                                                        $pro->product_price *
                                                        ((100 - $pro->sale_percent) / 100) *
                                                        $pro->quantity;
                                                }
                                            }
                                            echo $totalPrice;
                                        @endphp
                                        đ
                                    </span></p>
                                <p class="mb-0">Trạng Thái: <span>
                                        {{ $bill->status_name }}
                                    </span></p>
                            </div>
                        </div>
                        <!-- Add class 'active' to progress -->
                        <div class="row d-flex justify-content-center mt-5">
                            <div class="col-12">
                                <ul id="progressbar" class="text-center d-flex justify-content-center">
                                    <li class="<?php if ($bill->status_id >= 2 && $bill->status_id < 5 || $bill->status_id == 6) {
                                        echo 'active';
                                    } ?> step0"></li>
                                    <li class=" <?php if ($bill->status_id >= 3 && $bill->status_id < 5 || $bill->status_id == 6) {
                                        echo 'active';
                                    } ?> step0"></li>
                                    <li class=" <?php if ($bill->status_id == 4 || $bill->status_id == 6) {
                                        echo 'active';
                                    } ?> step0"></li>
                                </ul>
                            </div>
                        </div>
                        <div class="row p-0 m-0 top justify-content-between m-5">
                            <div
                                class="col-3 d-flex flex-wrap icon-content p-0 d-flex justify-content-center align-items-center">
                                <img class="icon" src="https://i.imgur.com/9nnc9Et.png">
                                <div class="">
                                    <p class="m-0">Đơn Hàng Đã<br>Được Xác Nhận</p>
                                </div>
                            </div>
                            <div
                                class="col-3 d-flex flex-wrap icon-content p-0 d-flex justify-content-center align-items-center">
                                <img class="icon" src="https://i.imgur.com/u1AzR7w.png">
                                <div class="">
                                    <p class="m-0">Đã Được Bàn Giao<br>Cho Đơn Vị Vận Chuyển</p>
                                </div>
                            </div>
                            <div
                                class="col-3 d-flex flex-wrap icon-content p-0 d-flex justify-content-center align-items-center">
                                <img class="icon" src="https://i.imgur.com/HdsziHP.png">
                                <div class="">
                                    <p class="m-0">Đơn Hàng<br>Đã Đến</p>
                                </div>
                            </div>
                        </div>
                        @if ($bill->status_id == 2)
                            <button class="btn-cant-cancel">Đơn hàng đã được xác nhận </button>
                        @elseif($bill->status_id == 3)
                            <button class="btn-cant-cancel">Đơn hàng đang trong quá trình vận chuyển </button>
                        @elseif($bill->status_id == 4 || $bill->status_id == 6)
                            <button class="btn-cant-cancel">Đơn hàng đã giao thành công </button>
                        @elseif($bill->status_id == 5)
                            <button class="btn-cancel">Đơn hàng đã bị hủy bởi bạn </button>
                        @elseif($bill->status_id == 1)
                        <button class="btn-cant-cancel">Đơn hàng đang chờ được xác nhận </button>
                        <form  action="{{ route('bill.cancel') }}" method="post">
                            @csrf
                            <input value="{{ $bill->id }}" type="hidden" name="id" id="">
                            <button type="submit" class="btn-cancel" style="border: none; width:100%; height:40px"
                            onclick="return confirm('Bạn có chắc là muốn hủy đơn hàng không?');">Hủy Đơn Hàng</button>
                        </form>
                        @endif


                    </div>
                @else
                @endif
            @endforeach
        @endif


    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></script>
@endsection
