<!-- index.blade.php -->
@extends('./admin.base')

<!-- title -->
@section('title') Trang Quan ly nguoi dung @endsection 
@section('breadcrumb') User @endsection 
<!-- slide -->
@section('content')
<div class="container">
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">Username</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Avatar</th>
      <th scope="col">Role</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone }}</td>
            <td><img src="{{ asset('images/users/' . $user->avatar) }}" class="img-thumbnail" width="50px" alt="Mô tả ảnh"></td>
            <td>{{ $user->role }}</td>
            <td>
                <form action="" method="post">
                    <a href="" class="btn btn-info">Edit</a>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
  </tbody>
</table>
<a href="{{route('users.create')}}" class="btn btn-primary">New User</a>
</div>
@endsection