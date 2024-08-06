@extends('main')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Thêm Sales</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="form-valide" action="{{ route('ad-sale.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-username">Phần trăm sale
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="number" min="0" max="100"
                                                class="form-control" id="val-username" name="sale_percent" >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-skill">Sản phẩm sale
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="form-control" id="val-skill" name="product_id">
                                                  
                                                        @foreach ($products as $pro)
                                                        @if ($pro->sale_id)
                                                        <option hidden value="{{ $pro->product_id }}">{{ $pro->product_name }}</option>
                                                        @else
                                                        <option selected value="{{ $pro->product_id }}">{{ $pro->product_name }}</option>
                                                        @endif
                                                        
                                                        @endforeach
                                               
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-8 ml-auto">
                                                <input type="submit" class="btn btn-primary" name="them" id="" value="Thêm">
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