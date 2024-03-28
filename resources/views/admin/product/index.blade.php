<!-- index.blade.php -->
@extends('./admin.base')

<!-- title -->
@section('title') Trang quản lý sản phẩm @endsection 
@section('breadcrumb') Product @endsection 
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
      <th scope="col">STT</th>
      <th scope="col">Name</th>
      <th scope="col">Brand_ID</th>
      <th scope="col">Category_Id</th>
      <th scope="col">Quantity In Stock</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @if($products)
      @foreach($products as $key => $data)
      <tr>
        <th scope="row">{{$key}}</th>
        <td>{{$data->name}}</td>
        <td>{{$data->brand_id}}</td>
        <td>{{$data->category_id}}</td>
        <td>{{$data->quantity_in_stock}}</td>
        <td>{{$data->status}}</td>
        <td style="display: flex; justify-content: space-evenly;">
          <a href="{{ route('products.edit', $data->id) }}"><i class="fa-regular fa-eye"></i></a>
          <form action="{{ route('products.destroy', $pro_image_id = $data->id) }}" method="post">
              @method('delete')
              @csrf
              <button style="color: cornflowerblue; background: none; border: none;" type="submit">
                  <i class="fa-regular fa-trash-can"></i>
              </button>
          </form>
        </td>
      </tr>
      @endforeach
    @endif
  </tbody>
</table>
<a href="{{route('products.create')}}" class="btn btn-primary">New Product</a>
</div>
@endsection

