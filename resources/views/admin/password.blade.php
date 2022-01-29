@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-4 mx-auto">

        <div class="main-content">
            <div class="breadcrumb">
                <h1>Reset my password</h1>
          
            </div>
            <div class="separator-breadcrumb border-top"></div>
       
             <form action="#" method="post"></form>
           <div class="form-group">
               <label class="mb-0">New password</label>
               <input type="password" name="password" required class="form-control">
           </div>
           <div class="form-group">
            <label class="mb-0">Confirm New password</label>
            <input type="password" name="confirm_password" required class="form-control">
        </div>   
            
         <div class="form-group">
             <button type="submit" class="btn btn-primary pl-3 pr-3 btn-block">Save new password</button>
         </div>
        

         

          
        </div>


    </div>
</div><!-- ============ Search UI Start ============= -->




    </div>
</div>
@endsection