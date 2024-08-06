@extends('welcome')

@section('title')
    Tài khoản - {{Auth::user()->name}}
@endsection

@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="text-center text-light">Thông tin tài khoản</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
{{--    Hiển thị thông báo thành công--}}
    @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif

    {{--    Hiển thị thông báo lỗi--}}
    @if(session('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
    @endif
                    <form action="{{ route('acc.update') }}" method="POST">
                        @csrf
                        <div class="">
                            <div class="mb-3">
                                <label for="username" class="form-label">Tên</label>
                                <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
                            </div>
                        </div>
                        <div class="">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}">
                            </div>
                        </div>
                        <div class="">
                            <div class="mb-3">
                                <label for="password" class="form-label">Mật khẩu</label>
                                <input type="password" class="form-control" name="password" value="{{ Auth::user()->password }}">
                            </div>
                        </div>
                        <div class="">
                            <div class="mb-3">
                                <label for="password" class="form-label">Số điện thoại</label>
                                <input type="number" class="form-control" name="phone" value="{{ Auth::user()->phone }}">
                            </div>
                        </div>
                        <div class="">
                            <div class="mb-3">
                                <label for="password" class="form-label">Địa chỉ</label>
                                <input type="text" class="form-control" name="address" value="{{ Auth::user()->address }}">
                            </div>
                        </div>
                        <center><button type="submit" class="btn btn-primary">Sửa thông tin</button></center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
@endsection