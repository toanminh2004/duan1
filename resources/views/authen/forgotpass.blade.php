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
            <h3>Khôi phục mật khẩu</h3>
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
            <form action="{{ route('sendEmailResetPass') }}" method="POST">
                @csrf
            <div class="row">
                <div class="">
                    <div class="mb-3">
                        <label for="email" class="form-label">Nhập email bạn đã đăng kí</label>
                        <input type="email" class="form-control" name="email"
                        placeholder="abc@gmail.com" required>
                      </div>
            </div>
            </div>
              <div class="">
                <button type="submit" class="btn btn-primary">Khôi phục mật khẩu</button>
              </div>
            </form>
          </div>
        </div>
      </div>
  </center>
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection