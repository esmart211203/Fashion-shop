<!-- index.blade.php -->
@extends('./admin.base')

<!-- title -->
@section('title') Trang Quan ly danh mục @endsection 
@section('breadcrumb') Order @endsection 

@section('content')
<div class="container">
    <table class="table table-hover table-bordered">
    <thead class="table-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">User order</th>
            <th scope="col">Total amount</th>
            <th scope="col">Price</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $key => $value)
            <tr>
                <th scope="row">{{++$key}}</th>
                <th scope="row">{{$value->receiver}}</th>
                <th scope="row">{{$value->total_amount}}</th>
                <th scope="row">{{$value->price}}</th>
                <th scope="row">{{$value->status}} 
                    @if($value->status == 'Processing')
                        <a href="{{route('orders.approve', $value->id)}}"><i class="fa-solid fa-truck"></i></a>
                    @endif
                </th>
                <th scope="row">
                    <form method="POST" action="{{route('orders.destroy', $value->id)}}">
                        <a href="{{route('orders.detail', $value->id)}}"><i class="fa-solid fa-eye"></i></a>
                        <a href="#"><i class="fa-solid fa-pen-to-square ml-2"></i></a>
                        @method('DELETE')
                        @csrf
                        <button type="submit" style="border: none;color: red;background: none;"><i class="fa-solid fa-delete-left"></i></button>
                    </form>
                </th>
            </tr>
        @endforeach
    </tbody>
    </table>
</div>
@endsection