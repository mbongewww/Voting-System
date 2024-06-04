@if(!empty(session('success')))
   <div class="alert alert-success" role="alert">
   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
    {{session('success')}}
   </div>
@endif

@if(!empty(session('error')))
   <div class="alert alert-danger" role="alert">
   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
    {{session('error')}}
   </div>
@endif