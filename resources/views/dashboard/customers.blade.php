@extends('layouts.app')
@section('content')
    
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card text-left">
                <div class="card-body">
                    <h4 class="card-title mb-5 font-weight-bold">Customers</h4>
  
                   <div class="table-responsive">
                        <div id="zero_configuration_table_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                          
                                            <div class="row"><div class="col-sm-12">
                                                
                                                
                                                <table class="display table table-striped table-bordered dataTable" id="zero_configuration_table" style="width: 100%;" role="grid" aria-describedby="zero_configuration_table_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="zero_configuration_table" rowspan="1" colspan="1" style="width: 46px;">User type</th> 
                                    <th class="sorting_asc" tabindex="0" aria-controls="zero_configuration_table" rowspan="1" colspan="1" style="width: 46px;">Name</th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="zero_configuration_table" rowspan="1" colspan="1" style="width: 46px;">Business Name</th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="zero_configuration_table" rowspan="1" colspan="1" style="width: 46px;">Phone</th>
                                    <th class="sorting" tabindex="0" aria-controls="zero_configuration_table" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 29px;">Email address</th>
                                    <th class="sorting" tabindex="0" aria-controls="zero_configuration_table" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 29px;">Registration Date</th>
                                <th class="sorting" tabindex="0" aria-controls="zero_configuration_table" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 26px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($collection as $item)
                                <tr role="row">
                                    <td class="text-capitalize">{{ $item->usertype }}</td>
                                    <td class="text-capitalize">{{ $item->name }}</td>
                                    <td class="text-capitalize">{{ $item->businessname }}</td>
                                    <td class="text-capitalize"><a title="click to call" href="tel:{{ $item->phone }}">{{ $item->phone }}</a></td>
                                    <td class="text-lowercase">{{$item->email }}</td>
                                    <td class="text-lowercase">{{$item->reg_date }}</td>
                                  
                                    <td><a href="{{ route('cdetails', ['id' => $item->id]) }}" class="btn btn-primary btn-sm pl-3 pr-3">Details</a></td>
                              
                                </tr> 
                                @endforeach
                          
                            
                            </tbody>
                           
                        </table></div></div>
                
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

</div>


@endsection