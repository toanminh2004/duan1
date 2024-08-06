@extends('main')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Danh Sách Danh Mục</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>ID Danh Mục</th>
                                            <th>Tên Danh Mục</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $category->id }}</td>
                                                <td>{{ $category->category_name }}</td>
                                                <td><a href="{{ route('ad-category.edit', $category->id) }}"><button
                                                            class="btn btn-primary ">Sửa</button></a>
                                                            <form action="{{ route('ad-category.destroy', $category->id) }}" 
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger mt-3 "
                                                                onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')"
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
