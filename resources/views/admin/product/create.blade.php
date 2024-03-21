@extends('admin.base')
<!-- title -->
@section('title') Thêm danh mục @endsection 
<!-- slide -->
@section('content')
<div class="container">
    <form method="POST" action="{{route('products.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="text" class="form-control" name="name" placeholder="Enter product name">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Brand</label>
        <select class="form-control" name="brand_id">
        @foreach ($brands as $data)
            <option value="{{$data['id']}}">{{$data['name']}}</option>
        @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Category</label>
        <select class="form-control" name="category_id">
            @foreach ($categories as $data)
                <option value="{{$data['id']}}">{{$data['name']}}</option>
            @endforeach
        </select>
    </div>
    <div class="row">
        <div class="form-group col-md-8">
            <label for="exampleInputEmail1">Price</label>
            <input type="number" class="form-control" name="price" min="1" max="9999" value="1">
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Quantity</label>
            <input type="number" class="form-control" name="quantity_in_stock" min="1" max="1000" value="1">
        </div>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Images</label>
        <input type="file" name="images[]" multiple accept="image/*" class="form-control" >
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Description</label>
        <textarea class="form-control" name="description" rows="3"></textarea>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Status</label>
        <select class="form-control" name="status">
            @foreach ($status as $key => $value)
                <option value="{{$value}}">{{$value}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-check mt-2 mb-2">
        <input class="form-check-input" type="checkbox" name="feature" value="1" id="flexCheckIndeterminate">
        <label class="form-check-label" for="flexCheckIndeterminate">Feature</label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection