@extends('welcome')

@section('title')
    Danh mục - {{ $category->category_name }}
@endsection

@section('content')
    <style>
        .side_banner1 {
            position: fixed;
            width: 10%;
            margin-top: 16px;
            left: 40px;
            border-radius: 5px;
            z-index: -1;
            box-shadow: 0px 0px 5px gray;
        }

        .side_banner2 {
            position: fixed;
            width: 10%;
            margin-top: 16px;
            right: 40px;
            border-radius: 5px;
            z-index: -1;
            box-shadow: 0px 0px 5px gray;
        }
    </style>

    <!-- -------------------------------------------------------------------------------------------------------- Đường Dẫn Và Hiển Thị Số Sản Phẩm ------------ -->
    <div class="container mt-3">

        <div class="row">

            <div class="col-md-8 mb-3">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none">Trang Chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Danh Mục</li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $category->category_name }}</li>
                    </ol>
                </nav>
            </div>

            <div class="col-md-4 text-md-end">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">

                    {{-- if (isset($_POST['btn_search']) || isset($_POST['btn_filter'])) 
                    <p>Tìm thấy
                         Sản Phẩm
                    </p> --}}

                </nav>
            </div>

        </div>

    </div>

    <div class="container pb-3 mb-5" style="">
        <div class="row">

            <!-- -------------------------------------------------------------------------------------------------------------- Bộ Lọc Tổng Hợp ------------ -->


            <!-- --------------------------------------------------------------------------------------------------------------------- Sản Phẩm ---------------- -->

            {{-- foreach ($product as $key => $value) {
            $price_format = number_format($value['price'], 0, ".", ".");
            $discount_format = number_format($value['discount'], 0, ".", ".");
            $sale = 100 - ($value['discount'] / ($value['price'] / 100)); --}}
                <div class="container pb-3 my-5"
                    style="background-color: white; border-radius: 10px; box-shadow: 0px 0px 5px gainsboro;">
                    <div class="row p-0">
                        <div class="d-flex justify-content-start">
                            <h2 class="title-product m-0"> {{ $category->category_name }} </h2>
                        </div>
                        @foreach ($products as $pro)
                            @if ($pro->category_id == $category->id)
                                <div class="col-6 col-md-4 col-lg-3 col-xl-2 mt-4 mb-5">
                                    <div class="card" style="width: 100%;">
                                        <div class="collection-img position-relative">
                                            <a href=" {{ route('product.show', $pro->product_id) }}"><img
                                                    src=" {{ Storage::url($pro->product_image) }} " class="card-img-top"
                                                    alt="..."></a>

                                            @foreach ($sales as $sale)
                                                @if ($pro->sale_id == $sale->sale_id)
                                                    <span
                                                        class="position-absolute bg-primary text-white d-flex align-items-center justify-content-center">-
                                                        {{ $pro->sale_percent }}%
                                                    </span>
                                                @endif
                                            @endforeach

                                        </div>
                                        <div class="card-body">
                                            <div class="product-title">
                                                <a href=" {{ route('product.show', $pro->product_id) }}">
                                                    {{ $pro->product_name }}
                                                </a>
                                            </div>
                                            <div>
                                                @foreach ($sales as $sale)
                                                    @if ($pro->sale_id == $sale->sale_id)
                                                        <del class="old-price">
                                                            {{ $pro->product_price }}đ
                                                        </del>
                                                        <span class="new-price">
                                                            đ
                                                        </span>
                                                    @else
                                                    @endif
                                                @endforeach
                                                <span class="new-price">
                                                    {{ $pro->product_price }}đ
                                                </span>
                                            </div>
                                            <div>
                                                <span class="rate-quantity">{{ $pro->product_description }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </div>
                    <center>
                        <a href="/categories"
                        style="
                    display: inline-block;
                    padding: 10px 20px;
                    text-decoration: none;
                    color: #fff;
                    background-color: #007bff;
                    border-radius: 5px;
                    transition: background-color 0.3s, box-shadow 0.3s;">
                    Quay lại trang danh mục</a>
                    </center>
                    
                </div>

        </div>
    </div>
    </div>


    </div>

    <!-- --------------------------------------------------------------------------------------------------------------------------- Phân Trang ------------ -->
    </div>
@endsection
