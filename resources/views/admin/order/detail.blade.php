<!-- index.blade.php -->
@extends('./admin.base')

<!-- title -->
@section('title') Order detail @endsection 
@section('breadcrumb') OrderItems @endsection 

@section('content')
<div class="container">
    <table class="table table-hover table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Product</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orderitems as $key => $value)
                <tr>
                    <th scope="row">{{++$key}}</th>
                    <th scope="row">{{$value->product->name}}</th>
                    <th scope="row">{{$value->quantity}}</th>
                    <th scope="row">{{$value->price}}</th>
                </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
    <h1 class="">Infomation Order</h1>
    <div class="row bg-secondary p-3" style="max-width: 500px;border-radius: 5px;">
            <div class="col-sm-3">
                <span class="font-weight-bold">Receiver:</span>
                <span class="font-weight-bold">Phone:</span>
                <span class="font-weight-bold">Address:</span>
            </div>
            <div class="col-sm-9">  
                <span>{{$order->receiver}}</span><br>
                <span>{{$order->phone}}</span><br>
                <span>{{$order->address}}</span>
            </div>
    </div>
</div>
@endsection