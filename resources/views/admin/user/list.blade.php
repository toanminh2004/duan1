@extends('main')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Danh Sách Người Dùng</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>ID Người Dùng</th>
                                            <th>Tên Người Dùng</th>
                                            <th>Số Điện Thoại</th>
                                            <th>Email</th>
                                            <th>Địa chỉ</th>
                                            <th>Quyền</th>
                                            <th>Mô Tả</th>
                                            <th>Cấp quyền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->user_id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->phone }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->address }}</td>
                                                <td>{{ $user->role_name }}</td>
                                                <td>{{ $user->role_description }}</td>
                                                <td>
                                                        <form action="{{ route('updateRoleAcc') }}" 
                                                                method="POST">
                                                                @csrf
                                                                <input type="hidden" name="user_id" value="{{ $user->user_id }}">
                                                                <input type="hidden" name="role_id" value="1">
                                                                <button type="submit" class="btn btn-info mt-3 text-light"
                                                                onclick="return confirm('Bạn có chắc chắn muốn cấp quyền admin cho user này?')"
                                                                >Admin</button>
                                                        </form>

                                                        <form action="{{ route('updateRoleAcc') }}" 
                                                                method="POST">
                                                                @csrf
                                                                <input type="hidden" name="user_id" value="{{ $user->user_id }}">
                                                                <input type="hidden" name="role_id" value="2">
                                                                <button type="submit" class="btn btn-primary mt-3 "
                                                                onclick="return confirm('Bạn có chắc chắn muốn xóa quyền admin cho user này?')"
                                                                >User</button>
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
