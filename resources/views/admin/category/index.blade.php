<!-- index.blade.php -->
@extends('./admin.base')

<!-- title -->
@section('title') Trang Quan ly danh mục @endsection 
@section('breadcrumb') Category @endsection 
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
      <th scope="col">Parent cate_id</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($categories as $data)
    <tr>
      <th scope="row">{{$data->id}}</th>
      <td>{{$data->name}}</td>
      <td><img src="{{ asset('images/category/' . $data->image) }}" class="img-thumbnail" width="50px" alt="Mô tả ảnh">
      <td>{{$data->description}}</td>
      <td>
        @if($data->parent_category_id != null)
          {{$data->parent_category_id}}
        @else
          null
        @endif
      </td>
      <td >
        <form method="POST" action="{{ route('categories.destroy', $data->id) }}">
          <a href="{{ route('categories.edit', $data->id) }}" class="btn btn-info">Edit</a>
          @method('DELETE')
          @csrf
          <button class="btn btn-danger" type="submit">Delete</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
<a href="{{route('categories.create')}}" class="btn btn-primary">New Category</a>
</div>
@endsection

