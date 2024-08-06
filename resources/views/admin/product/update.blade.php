@extends('main')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Sửa Sản Phẩm</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="form-valide" action="{{ route('ad-product.update', $product->product_id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-xl-6">
                                        <input type="number" name="product_id" hidden id="">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-username">Tên sản phẩm
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input value="{{ $product->product_name }}" type="text" class="form-control" id="val-username" name="product_name" >
                                            </div>
                                        </div>
                                        <img src="{{ Storage::url( $product->product_image) }}" width="200" alt="">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Ảnh</span>
                                            </div>
                                            <div class="custom-file">
                                                <input name="product_image" type="file" class="custom-file-input">
                                                <label class="custom-file-label">Chọn ảnh sản phẩm</label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-username">Giá
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="number" value="{{ $product->product_price }}" class="form-control" id="val-username" name="product_price">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-username">Mô tả
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" value="{{ $product->product_description }}" class="form-control" id="val-username" name="product_description" >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-username">Thông tin
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" value="{{ $product->product_information }}" class="form-control" id="val-username" name="product_information" >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-skill">Hãng
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="form-control" id="val-skill" name="category_id">
                                                  
                                                        @foreach ($categories as $cate)
                                                        @if ($cate->id == $product->category_id)
                                                        <option value="{{ $cate->id }}" selected>{{ $cate->category_name }}</option>
                                                        @else
                                                        <option value="{{ $cate->id }}">{{ $cate->category_name }}</option>
                                                        @endif
                                                       
                                                        @endforeach
                                               
                                                </select>
                                            </div>
                                        </div>
                                        <input type="hidden" name="product_id" id="">
                                        <div class="form-group row">
                                            <div class="col-lg-8 ml-auto">
                                                <input type="submit" class="btn btn-primary" name="them" id="" value="Sửa">
                                            </div>
                                            
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-8 ml-auto">
                                                <a href="{{ route('ad-product.index') }}" class="btn btn-info">Quay lại trang danh sách</a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection