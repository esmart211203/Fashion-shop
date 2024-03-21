@extends('admin.base')
<!-- title -->
@section('title') Sửa sản phẩm @endsection 
<!-- slide -->
@section('content')
<style>
#pro_imgs {
    width: 100%;
    position: relative;
}

#pro_imgs button {
    position: absolute;
    top: 10px;
    left: 20px;
}

#pro_imgs img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}
</style>
<div class="container">
    <form method="POST" action="{{route('products.update', $product->id)}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" name="name" value="{{$product->name}}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Brand</label>
            <select class="form-control" name="brand_id">
            @foreach ($brands as $data)
                <option @if ($product->brand_id === $data->id) selected @endif value="{{$data['id']}}">{{$data['name']}}</option>
            @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Category</label>
            <select class="form-control" name="category_id">
                @foreach ($categories as $data)
                    <option @if ($product->category_id === $data->id) selected @endif value="{{$data['id']}}">{{$data['name']}}</option>
                @endforeach
            </select>
        </div>
        <div class="row">
            <div class="form-group col-md-8">
                <label for="exampleInputEmail1">Price</label>
                <input type="number" class="form-control" name="price" min="1" max="1000" value="{{$product->price}}">
            </div>
            <div class="form-group col-md-4">
                <label for="exampleInputEmail1">Quantity</label>
                <input type="number" class="form-control" name="quantity_in_stock" min="1" max="1000" value="{{$product->quantity_in_stock}}">
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Images</label>
            <input type="file" name="images[]" multiple accept="image/*" class="form-control" >
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Description</label>
            <textarea class="form-control" name="description" rows="3">{{$product->description}}</textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Status</label>
            <select class="form-control" name="status">
                @foreach ($status as $key => $value)
                    <option value="{{$value}}" @if ($product->status === $value) selected @endif >{{$value}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-check mt-2 mb-2">
            <input class="form-check-input" type="checkbox" @if($product->featured === 1) checked @endif name="feature" value="1" id="flexCheckIndeterminate">
            <label class="form-check-label" for="flexCheckIndeterminate">Feature</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <div class="row" id="pro_imgs">
        @if($product_images)
            @foreach($product_images as $data)
                <div class="col-3 mb-2" id="img-pro-{{$data->id}}">
                    <img src="{{ asset('images/product_images/' . $data->name) }}" alt="image product" style="width: 200px; height: 200px;">
                    <form action="{{ route('products.delete.image',$pro_image_id=$data->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="delete-button" type="submit"><i class="fa-solid fa-xmark" style="font-size: 12px;"></i></button>
                    </form>
                </div>
            @endforeach
        @endif
    </div>

</div>
@endsection