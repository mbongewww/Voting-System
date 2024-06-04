@extends('admin.app')

@section('style')

@endsection

@section('content')
   
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Positions
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Positions</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        @if(!empty(session('error')))
        
        <div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <h4><i class='icon fa fa-warning'></i> Error!</h4>
        {{session('error')}}
        </div>
    
    
       @endif
       @if(!empty(session('success')))

        <div class='alert alert-success alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <h4><i class='icon fa fa-check'></i> Success!</h4>
        {{session('error')}}
        </div>
    
       @endif
        
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th class="hidden"></th>
                  <th>Positions</th>
                  <th>Maximum Vote</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                       @foreach($getPositions as $position)
                        <tr>
                          <td class='hidden'></td>
                          <td>{{$position->position}}</td>
                          <td>{{$position->maximum_vote}}</td>
                          <td>
                            <button class='btn btn-success btn-sm edit btn-flat' data-id='{{$position->id}}'><i class='fa fa-edit'></i> Edit</button>
                            <button class='btn btn-danger btn-sm delete btn-flat' data-id='{{$position->id}}'><i class='fa fa-trash'></i> Delete</button>
                          </td>
                        </tr>
                       @endforeach 
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
  <!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add New Position</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal"  id="submitPosition" method="POST" action="">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="position" class="col-sm-3 control-label">Position</label>

                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="position" name="position" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="maximum_vote" class="col-sm-3 control-label">Maximum Vote</label>

                        <div class="col-sm-9">
                          <input type="number" class="form-control" id="maximum_vote" name="maximum_vote" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                  <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
             </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit -->

<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Edit Position</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" id="updatePosition" method="POST" action="">
                      @csrf
                      <input type="hidden" class="id" name="id">
                      <div class="form-group">
                          <label for="edit_position" class="col-sm-3 control-label">position</label>

                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="edit_position" name="position">
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="edit_maximum_vote" class="col-sm-3 control-label">Maximum Vote</label>

                          <div class="col-sm-9">
                            <input type="number" class="form-control" id="edit_maximum_vote" name="maximum_vote">
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                    <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
            </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Deleting...</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" id="deletePosition" method="POST" action="">
                {{ csrf_field() }}
                <input type="hidden" class="id" name="id">
                <div class="text-center">
                    <p>DELETE POSITION</p>
                    <h2 class="bold description"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i> Delete</button>
              </form>
            </div>
        </div>
    </div>
</div>



     
    

@endsection
@section('script')
<script>
 
  $(function(){
    $(document).on('click', '.edit', function(e){
      e.preventDefault();
      $('#edit').modal('show');
      var id = $(this).data('id');
      getRow(id);
    });

    $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: '{{url('admin/getposition')}}',
    data: {
        "_token": "{{ csrf_token() }}",
        "id": id
        },
    dataType: 'json',
    success: function(response){
      $('.id').val(response.id);
      $('#edit_position').val(response.position);
      $('#edit_maximum_vote').val(response.maximum_vote);
      $('.description').html(response.description);
    }
  });
}

    $('body').delegate('#submitPosition', 'submit', function(e){
      e.preventDefault();
      var formData = new FormData(this);

      $.ajax({
      type : "POST",
      url : "{{ url('admin/create_position') }}",
      processData: false,
      contentType: false,
      data: formData,
      dataType : "json",
      success: function(data)
      {
          if(data.status == true){
              location.reload();
          }else{
              alert(data.message);
          }

      },
      error: function(data){

      }
    });

    });

    $('body').delegate('#updatePosition', 'submit', function(e){
      e.preventDefault();
      var formData = new FormData(this);

      $.ajax({
      type : "POST",
      url : "{{ url('admin/update_position') }}",
      processData: false,
      contentType: false,
      data: formData,
      dataType : "json",
      success: function(data)
      {
          if(data.status == true){
              location.reload();
          }else{
              alert(data.message);
          }

      },
      error: function(data){

      }
    });

    });

    

    $('body').delegate('#deletePosition', 'submit', function(e){
      e.preventDefault();
      var formData = new FormData(this);

      $.ajax({
      type : "POST",
      url : "{{ url('admin/delete_position') }}",
      processData: false,
      contentType: false,
      data: formData,
      dataType : "json",
      success: function(data)
      {
          if(data.status == true){
              location.reload();
          }else{
              alert(data.message);
          }

      },
      error: function(data){

      }
    });

    });


</script>
@endsection

