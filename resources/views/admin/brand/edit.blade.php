@extends('admin.base')
<!-- title -->
@section('title') Sửa thương hiệu @endsection 
<!-- slide -->
@section('content')
<div class="container">
    <form method="POST" action="{{route('brands.update', $brand->id)}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="text" class="form-control" name="name" value="{{$brand->name}}">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Image</label>
        <input type="file" name="image" class="form-control">
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Description</label>
        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{$brand->description}}</textarea>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Parent Category</label>
        <select class="form-control" name="category_id">
        @foreach ($categories as $data)
            <option value="{{$data['id']}}" @if($brand->category_id === $data->id) selected @endif>{{$data['name']}}</option>
        @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection