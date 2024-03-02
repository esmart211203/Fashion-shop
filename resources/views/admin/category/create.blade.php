@extends('admin.base')
<!-- title -->
@section('title') Thêm danh mục @endsection 
<!-- slide -->
@section('content')
<div class="container">
    <form method="POST" action="{{route('categories.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="text" class="form-control" name="name" placeholder="Enter title">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Image</label>
        <input type="file" name="image" class="form-control" >
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Description</label>
        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Parent Category</label>
        <select class="form-control" name="parent_category_id">
        <option value="0" selected>None</option>  
        @foreach ($categories as $data)
            <option value="{{$data['id']}}">{{$data['name']}}</option>
        @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection