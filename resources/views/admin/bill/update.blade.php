@extends('main')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="order-details">
            <h2 class="text-center mb-4">Chi Tiết Đơn Hàng</h2>
            <div class="row">
                <!-- Order Summary -->
                <div class="col-md-4 order-summary">
                    <h4 class="mb-3">Thông Tin Đơn Hàng</h4>
                    <p><strong>Mã Đơn Hàng:</strong> #{{ $bill->id }}</p>
                    <p><strong>Trạng Thái:
                        <form action="{{ route('ad-bill.update',$bill->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="id" class="form-control"
                            @if ($bill->status_id ==5)
                            {{ 'disabled' }}                                
                            @endif
                            >
                                @foreach ($status as $item)
                                @if ($item->id == $bill->status_id)
                                <option class="" selected value="{{ $item->id }}">{{ $item->name }}</option>
                                @elseif ($item->id < $bill->status_id or $item->id ==5 or $item->id ==6)
                                <option class="" hidden value="{{ $item->id }}"></option>
                                @else
                                <option class=""value="{{ $item->id }}">{{ $item->name }}</option>
                                @endif
                            @endforeach
                            </select>
                        @if ($bill->status_id ==5)
                        <input disabled class="btn btn-danger mt-3" value="Đơn hàng đã bị hủy">
                        @else
                        <input type="submit" class="btn btn-primary mt-3" name="them" id="" value="Thay đổi trạng thái đơn hàng">
                        @endif
                        
                        </form>
                    </strong></p>

                    <p><strong>Phương Thức Thanh Toán:</strong> Thanh toán COD</p>
                    <hr>
                    <h4 class="mb-3">Thông Tin Khách Hàng</h4>
                    <p><strong>Tên:</strong> {{ $bill->name }} </p>
                    <p><strong>Địa Chỉ:</strong> {{ $bill->address }}</p>
                    <p><strong>Số Điện Thoại:</strong> {{ $bill->phone }}</p>
                </div>
                <!-- Order Items -->
                <div class="col-md-8 order-items">
                    <h4 class="mb-3">Sản Phẩm Trong Đơn Hàng</h4>
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>ID Sản Phẩm</th>
                                <th>Sản Phẩm</th>
                                <th>Ảnh Sản Phẩm</th>
                                <th>Số Lượng</th>
                                <th>Giá</th>
                                <th>Thành Tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $pro)
                            <tr>
                                <td>{{ $pro->product_id }}</td>
                                <td>{{ $pro->product_name }}</td>
                                <td>
                                    <img width="120" height="130" src="{{ Storage::url($pro->product_image) }}" alt="">
                                </td>
                                <td>{{ $pro->quantity }}</td>
                                <td>{{ ($pro->product_price*(100-$pro->sale_percent))/100 }} VND
                                    @if ($pro->sale_percent)
                                    <span class="text-primary" >(Sale {{ $pro->sale_percent }}%)</span>
                                    @endif

                                </td>
                                <td>{{ (($pro->product_price*(100-$pro->sale_percent))/100) *$pro->quantity }} VND</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-end">
                        <h5><strong>Tổng Cộng:</strong> 
                            @php
                                        $totalPrice = 0;
                                        foreach ($products as $pro) {
                                                $totalPrice += $pro->product_price *((100 - $pro->sale_percent)/100) * $pro->quantity;
                                        }
                                        echo $totalPrice;
                                    @endphp
                             VND</h5>
                    </div>

                    @if ($bill->status_id ==4)
                    <form action="{{ route('sendEmailBill') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $bill->id }}">
                        <button type="submit" class="btn btn-warning text-light">
                            <i class="fas fa-envelope"></i>Gửi email hóa đơn</button>
                    </form>
                    @endif

                    <a class="btn btn-info text-light mt-3" 
                    href="{{ route('ad-bill.index') }}">Quay lại trang danh sách</a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection