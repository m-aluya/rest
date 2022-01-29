@extends('layouts.app')
@section('content')
    
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card text-left">
                <div class="card-body">
                    <h4 class="card-title mb-5 font-weight-bold">Shipments::{{request()->segment(count(request()->segments()))}}</h4>
           <div class="table-responsive">
                        <div id="zero_configuration_table_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                          
                                            <div class="row"><div class="col-sm-12">
                                                <table class="display table table-striped table-bordered dataTable" id="zero_configuration_table" style="width: 100%;" role="grid" aria-describedby="zero_configuration_table_info">
                                                    <thead>
                                                        <tr role="row">
                                                           
                                                            <th class="sorting_asc" tabindex="0" aria-controls="zero_configuration_table" rowspan="1" colspan="1" style="width: 46px;">Type</th>
                                                            <th class="sorting" tabindex="0" aria-controls="zero_configuration_table" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 29px;">Amount</th>
                                                            
                                                            <th class="sorting_asc" tabindex="0" aria-controls="zero_configuration_table" rowspan="1" colspan="1" style="width: 36px;">Delivery Status</th>
                                                            
                                                            <th class="sorting_asc" tabindex="0" aria-controls="zero_configuration_table" rowspan="1" colspan="1" style="width: 36px;">Last Update</th>
                                                            
                                                            <th class="sorting" tabindex="0" aria-controls="zero_configuration_table" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 39px;">Order ID</th>
                                                            <th class="sorting" tabindex="0" aria-controls="zero_configuration_table" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 26px;"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                        @foreach ($data as $item)
                                                        <tr role="row">
                                                            <td class="text-capitalize">{{ $item->type }}</td>
                                                            <td>{{ number_format($item->amount,2) }}</td>
                                                            <td>{{$item->delivery_status }}</td>
                                                            <td>{{ Carbon\Carbon::parse($item->updated_at)->format('d M Y')}}</td>
                                                            <td>{{$item->order_id }}</td>
                                                          
                                                          
                                                            <td><a href="{{ route('shipment.details', ['id' => $item->id]) }}" class="btn btn-primary btn-sm pl-3 pr-3">Details</a></td>
                                                      
                                                        </tr> 
                                                        @endforeach
                                                  
                                                    
                                                    </tbody>
                                                   
                                                </table>   
                                                
                                             </div></div>
                
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

</div>


@endsection