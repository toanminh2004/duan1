@extends('main')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Danh Sách Sale</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>ID Sale</th>
                                            <th>Phần trăm Sale</th>
                                            <th>Sản phẩm được sale Sale</th>
                                            <th>Ảnh sản phẩm</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sales as $sale)
                                            <tr>
                                                <td>{{ $sale->sale_id }}</td>
                                                <td>{{ $sale->sale_percent }}</td>
                                                <td>{{ $sale->product_name }}</td>
                                                <td>
                                                    <img width="100" height="100" src="{{ Storage::url($sale->product_image) }}" alt="">
                                                </td>
                                                <td><a href="{{ route('ad-sale.edit', $sale->sale_id) }}"><button
                                                            class="btn btn-primary mb-3">Sửa</button></a>
                                                            <form action="{{ route('ad-sale.delete', $sale->sale_id) }}" 
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger"
                                                                onclick="return confirm('Bạn có chắc chắn muốn xóa sale này?')"
                                                                >Xóa</button>
                                                            </form>
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
