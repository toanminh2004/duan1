@extends('main')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Sửa Sales</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="form-valide" action="{{ route('ad-sale.update',$sale->sale_id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-username">Phần trăm sale
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="number" min="0" max="100"
                                                class="form-control" value="{{ $sale->sale_percent }}" id="val-username" name="sale_percent" >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-skill">Sản phẩm sale
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="form-control" id="val-skill" name="product_id">
                                                  
                                                        @foreach ($products as $pro)
                                                        @if ($pro->product_id == $sale->product_id)
                                                        <option value="{{ $pro->product_id }}" selected>{{ $pro->product_name }}</option>
                                                        @else
                                                        <option value="{{ $pro->product_id }}">{{ $pro->product_name }}</option>
                                                        @endif
                                                        
                                                        @endforeach
                                               
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-8 ml-auto">
                                                <input type="submit" class="btn btn-primary" name="them" id="" value="Sửa">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-8 ml-auto">
                                                <a href="{{ route('ad-sale.index') }}" class="btn btn-info">Quay lại trang danh sách</a>
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