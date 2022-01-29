@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8 mx-auto mb-4">
            <div class="card text-left">
                <div class="card-header bg-primary text-white mb-0">
                    <h4 class="card-title text-white font-weight-bold">Order details</h4>
                </div>
           
                <?php 
$details->forget('delivery_confirmation_pin');
$details->forget('deleted_at');


?>
                <div class="card-body">
                  
                    <a class="btn btn-primary pl-4 pr-4 mb-3" href="{{ route('orders')}}">Go back</a>
                 
                    <table class="display table table-striped table-bordered">
    @foreach ($details as $key => $detail)
 <tr>
     @if ($key == 'status')
         @if ($detail == 1)
             <td class="text-uppercase font-weight-bold">Status</td>
             <td><span class="badge badge-success pl-3 pr-3 pt-2 pb-2">Resolved</span></td>
             
         @else
         <td class="text-uppercase font-weight-bold">Status</td>
         <td><span class="badge badge-danger pl-3 pr-3 pt-2 pb-2">Unresolved</span></td>
         
         @endif
     @else
     <td class="text-uppercase font-weight-bold">   {{ str_replace('_',' ',$key) }}</td> <td>{{ $detail }}</td>
 
     @endif
    </tr>
@endforeach

</table>


<h4 class="text-uppercase mt-4">Items</h4>
<table class="display table table-striped table-bordered">
    <thead>
        <th>Product Name</th>  <th>Quantity</th>  <th>Price</th>
    </thead>
    <tbody>
        @foreach ($items as $item) <tr> <td>{{$item->productname}}</td> <td>{{$item->quantity}}</td> <td>{{$item->price}}</td></tr>
        @endforeach
    </tbody>
</table>
<a class="btn btn-primary pl-4 pr-4 mb-3" href="{{ route('orders')}}">Go back</a>
               </div>
                
            </div>
        </div>
    </div>
</div>
@endsection