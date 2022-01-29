@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row mb-4">
      <div class="col-md-8 mx-auto mb-4">
          <div class="card text-left">
              <div class="card-header bg-primary text-white mb-0">
                  <h4 class="card-title text-white font-weight-bold">Dispute details</h4>
              </div>
              <div class="card-body">
 
       <?php 

$slade =  array( $details);
?>
<table class="display table table-striped table-bordered">
  @foreach ($details as $key => $detail)  
@if ($key == 'dispute_status')
<tr><td class="text-uppercase font-weight-bold">   {{ str_replace('_',' ',$key) }}</td> 
   <td>
  @if ($detail == 1)
      <span class="badge badge-success pr-3 pl-3 pt-2 pb-2">Resolved <i class="fa fa-check" aria-hidden="true"></i> </span>
  @else
  <span class="badge badge-danger pr-3 pl-3 pt-2 pb-2">Unresolved <i class="fa fa-remove" aria-hidden="true"></i> </span>
    
  @endif   
  </td> </tr> 
  
@else
<tr><td class="text-uppercase font-weight-bold">   {{ str_replace('_',' ',$key) }}</td>  <td>{{ $detail }}</td> </tr> 
    
@endif

  @endforeach
</table>
<div class="row">
@forelse ($files as $item)
        
             <div class="col-md-3 mb-3"><a href="#" data-img="{{ $item->file_link }}" class="vb"> <img class="img-fluid rounded mb-3" src="{{ $item->file_link }}"/></a>
              <a href="#" data-img="{{ $item->file_link }}" class="vb">View file</a>
          </div>
          
@empty


  
@endforelse
</div>
<hr class="mb-3 mt-3">
<a class="btn btn-primary pl-4 pr-4 mb-3" href="{{ route('disputes')}}"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Go back</a>
<button  type="button" class="btn btn-outline-success mb-3" data-toggle="modal" data-target="#exampleModal">Resolve dispute <i class="fa fa-pencil-square" aria-hidden="true"></i></button>
              </div>
              
          </div>
      </div>
  </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Resolve dispute</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('resolve',['id' => $details->get('id')])}}" method="post">
            @csrf
<input type="hidden" name="did" value="<?= $slade[0]['id'] ?>">
            <div class="form-group">
                <label class="mb-0">Resolution note</label>
                <textarea class="form-control" name="resolution" id="resolution" required></textarea>
            </div>
     <p class="text-center">
      <button type="submit" class="btn btn-primary pl-4 pr-4">Save</button>
     </p>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>





<div class="modal fade" id="img" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Dispute resolution file</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     <div id="v" class="text-center"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@include('layouts.footer')
<script>
  $(".vb").click(function(e){
      const img = $(this).data('img');
      $("#v").html('<img class="img-fluid" src="'+  img + '"/>');
      $("#img").modal('show');

  })
</script>
@endsection