@extends('layouts.app')
@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-6 mx-auto">
            <h3>Add Customer</h3>
            <div class="card mb-5">
                <div class="card-body">
                    <form method="post" class="p-3" action="{{route('customer.add')}}">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                        @if(session()->has('success'))
                        <div class="alert alert-success text-center">
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    @if(session()->has('error'))
                    <div class="alert alert-danger text-center">
                        {{ session()->get('error') }}
                    </div>
                @endif

                @csrf
                <div class="form-group mb-4"> 
                    <label class="mb-0">Name</label>
                    <input name="name" value="{{old('name')}}" class="form-control" id="name" type="text" placeholder="Arya Stark" />
    
         
                </div>
       

           <div class="form-group mb-4"> 
                <label class="mb-0">Phone Number</label>
                <input class="form-control" value="{{old('phone_no')}}" id="org_id" name="phone_no" type="text" autocomplete="off" placeholder="09033000000" />
            
            </div>
            <div class="form-group mb-4"> 
                <label class="mb-0">Business Name </label>
                <input class="form-control" value="{{old('businessName')}}" id="org_id" name="businessName" type="text" autocomplete="off" placeholder="Akpan Stores" />
            
            </div>
            <div class="form-group mb-4"> 
                <label class="mb-0">Referral Code</label>
                <input class="form-control" value="{{old('referral_code')}}" id="org_id" name="referral_code" type="text" autocomplete="off" placeholder="uey123" />
            
            </div>
            <div class="form-group mb-4">
                <label class="mb-0">Account type</label>
                <select required name="acct_type" class="custom-select">
                    <option value="" selected>--</option>
                    <option value="Buyer">Buyer</option>
                    <option value="Merchant">Merchant</option>
                    <option value="Both">Both</option>
                </select>
            </div>


            <div class="form-group mb-4"> 
                <label class="mb-0">Email address</label>
                <input name="email" value="{{old('email')}}" class="form-control" id="email" type="text" placeholder="aryastark@pepperest.com" />
              
            </div>
            <div class="form-group mb-4"> 
                <label class="mb-0">Password</label>
                <input name="password" class="form-control" id="email" type="password"/>
            </div>


            <div class="form-group">
              <button type="submit" class="btn btn-primary pl-3 pr-3">Create Account</button>
            </div>



<div class="alert alert-warning">
    Do well to write down the possword. Also inform the user to change the password after login.
</div>
           
<a class="mt-5" href="{{route('customers', ['type' => 'both'])}}">Customers</a>
                   
                    </form>
                </div>
            </div>
        </div>
    </div>
  
   
</div><!-- Footer Start -->


</div>
@endsection