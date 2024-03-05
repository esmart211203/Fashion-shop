<!-- index.blade.php -->
@extends('./admin.base')

<!-- title -->
@section('title') Trang Quan ly danh mục @endsection 
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
        <td>{{$data->image}}</td>
        <td>{{$data->description}}</td>
        <td>{{$data->category_id}}</td>
        <td style="display: flex; justify-content: space-evenly;">
          <a href="{{route('brands.edit', $data->id)}}"><i class="fa-regular fa-eye"></i></a>
          <form method="POST" action="{{ route('brands.destroy', $data->id) }}">
            @csrf
            @method('DELETE')
            <button style="color: cornflowerblue;
            background: none;border: none;" type="submit"><i class="fa-regular fa-trash-can"></i></button>
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

