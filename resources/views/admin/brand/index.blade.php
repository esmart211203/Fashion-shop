<!-- index.blade.php -->
@extends('./admin.base')

<!-- title -->
@section('title') Trang quản lý thương hiệu @endsection 
@section('breadcrumb') Brand @endsection 

@section('content')
<div class="container">
<table class="table table-hover table-bordered">
  @if(session('success') || session('update') || session('delete'))
          @if(session('success'))
          <div class="alert alert-primary">
              {{ session('success') }}
          </div>
          @elseif(session('update'))
          <div class="alert alert-info">
            {{ session('update') }}
          </div>
          @elseif(session('delete'))
          <div class="alert alert-danger">
          {{ session('delete') }}
          </div>
          @endif
  @endif
  <thead class="table-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Image</th>
      <th scope="col">Description</th>
      <th scope="col">Category</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @if($brands)
      @foreach($brands as $data)
      <tr>
        <th scope="row">{{$data->id}}</th>
        <td>{{$data->name}}</td>
        <td><img src="{{ asset('images/brand/' . $data->image) }}" class="img-thumbnail" width="50px" alt="Mô tả ảnh"></td>
        <td>{{$data->description}}</td>
        <td>{{$data->category_id}}</td>
        <td>
          <form method="POST" action="{{ route('brands.destroy', $data->id) }}">
            <a href="{{route('brands.edit', $data->id)}}" class="btn btn-info">Edit</a>
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    @endif
  </tbody>
</table>
<a href="{{route('brands.create')}}" class="btn btn-primary">New Brand</a>
</div>
@endsection

