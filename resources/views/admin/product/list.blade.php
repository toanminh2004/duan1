@extends('main')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Danh Sách Sản Phẩm</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>ID Sản Phẩm</th>
                                            <th>Tên Sản Phẩm</th>
                                            <th>Hãng</th>
                                            <th>Giá</th>
                                            <th>Ảnh</th>
                                            <th>Mô Tả</th>
                                            <th>Thông tin</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $product->product_id }}</td>
                                                <td>{{ $product->product_name }}</td>
                                                <td>{{ $product->category_name }}</td>
                                                <td>{{ $product->product_price }}</td>
                                                <td><img width=50px src="{{ Storage::url($product->product_image) }}" alt=""></td>
                                                <td>{{ $product->product_description }}</td>
                                                <td>{{ $product->product_information }}</td>
                                                <td><a href="{{ route('ad-product.edit', $product->product_id) }}"><button
                                                            class="btn btn-primary mb-3">Sửa</button></a>
                                                            <form action="{{ route('ad-product.delete', $product->product_id) }}" 
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger"
                                                                onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')"
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
