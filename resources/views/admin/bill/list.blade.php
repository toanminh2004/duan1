@extends('main')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Danh Sách Đơn Hàng</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>ID Đơn Hàng</th>
                                            <th>Tên Người Đặt</th>
                                            <th>Số Điện Thoại</th>
                                            <th>Địa chỉ</th>
                                            <th>Trạng Thái Đơn Hàng</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($billes as $bill)
                                            <tr>
                                                <td># {{ $bill->id }}</td>
                                                <td>{{ $bill->name }}</td>
                                                <td>{{ $bill->phone }}</td>
                                                <td>{{ $bill->address }}</td>
                                                <td>
                                                    
                                                    <p class="
                                                    @if ($bill->status_id == 5)
                                                    @{{ btn btn-danger }}
                                                    @elseif($bill->status_id == 4)
                                                    @{{ btn btn-success text-light }}
                                                    @elseif($bill->status_id == 3)
                                                    @{{ btn btn-dark text-light }}
                                                    @elseif($bill->status_id == 2)
                                                    @{{ btn btn-secondary text-light }}
                                                    @elseif($bill->status_id == 1)
                                                    @{{ btn btn-warning text-light }}
                                                    @elseif($bill->status_id == 6)
                                                    @{{ btn btn-success text-light }}
                                                    @endif
                                                    ">{{ $bill->status_name }}</p>
                                                    </td>
                                               <td>
                                                <a class="btn btn-info text-light" 
                                                href="{{ route('ad-bill.edit',$bill->id) }}">
                                                    Chi tiết đơn hàng
                                                </a>
                                               </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
