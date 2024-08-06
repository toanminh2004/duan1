@extends('welcome')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
      background: #f8f9fa;
    }
    .container1 {
      max-width: 900px;
      margin-top: 50px;
    }
    .card {
      border: none;
      border-radius: 1rem;
    }
    .card-header {
      background-color: #007bff;
      color: #fff;
      border-bottom: none;
      border-top-left-radius: 1rem;
      border-top-right-radius: 1rem;
    }
    .card-body {
      padding: 2rem;
    }
    .form-control {
      border-radius: 0.5rem;
    }
    .btn-primary {
      border-radius: 0.5rem;
    }
    .form-label {
        font-weight: bold;
    }
  </style>
  <center>
    <div class="container1 mb-5">
        <div class="card shadow-sm">
          <div class="card-header text-center">
            <h3>Đăng nhập</h3>
          </div>
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
          <div class="card-body">
            <form action="{{ route('postSignin') }}" method="POST">
                @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email"
                        placeholder="abc@gmail.com" value="{{ old('email') }}" required>
                      </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu</label>
                        <input type="password" class="form-control" name="password"
                        placeholder="******" value="{{ old('password') }}" required>
                      </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <p>Bạn chưa có tài khoản?<a href="/signup">Đăng kí tại đây</a></p>
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <a class="btn" href="/forgot-password">Quên mật khẩu</a>
                  </div>
              </div>
            </div>
              <div class="">
                <button type="submit" class="btn btn-primary">Đăng nhập</button>
              </div>
            </form>
          </div>
        </div>
      </div>
  </center>
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection