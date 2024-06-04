@extends('admin.app')

@section('style')

@endsection

@section('content')
   
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Voters List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Voters</li>
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
                  <th>Email</th>
                  <th>Lastname</th>
                  <th>Firstname</th>
                  <th>Photo</th>
                  <th>Voters ID</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                   @foreach($getVoters as $voter)
                        <tr>
                          <td>{{$voter->email}}</td>
                          <td>{{$voter->lastname}}</td>
                          <td>{{$voter->firstname}}</td>
                          <td>
                            <img src='{{!empty($voter->getPhoto()) ? $voter->getPhoto() : ''}}' width='30px' height='30px'>
                            <a href='#edit_photo' data-toggle='modal' class='pull-right photo' data-id='{{$voter->id}}'><span class='fa fa-edit'></span></a>
                          </td>
                          <td>{{$voter->voter_id}}</td>
                          <td>
                            <button class='btn btn-success btn-sm edit btn-flat' data-id='{{$voter->id}}'><i class='fa fa-edit'></i> Edit</button>
                            <button class='btn btn-danger btn-sm delete btn-flat' data-id='{{$voter->id}}'><i class='fa fa-trash'></i> Delete</button>
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
              <h4 class="modal-title"><b>Add New Voter</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" id="submitVoter" method="POST" action="" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                  <label for="email" class="col-sm-3 control-label">Email</label>

                  <div class="col-sm-9">
                    <input type="email" class="form-control" id="email" name="email" required>
                  </div>
              </div>
                <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">Firstname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="firstname" name="firstname" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastname" class="col-sm-3 control-label">Lastname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="lastname" name="lastname" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Password</label>

                    <div class="col-sm-9">
                      <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Photo</label>

                    <div class="col-sm-9">
                      <input type="file" id="photo" name="photo">
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
              <h4 class="modal-title"><b>Edit Voter</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" id="updateVoter" method="POST" action="">
                {{ csrf_field() }}
                <input type="hidden" class="id" name="id">
                <div class="form-group">
                  <label for="edit_email" class="col-sm-3 control-label">Email</label>

                  <div class="col-sm-9">
                    <input type="email" class="form-control" id="edit_email" name="email" required>
                  </div>
              </div>
                <div class="form-group">
                    <label for="edit_firstname" class="col-sm-3 control-label">Firstname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_firstname" name="firstname">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_lastname" class="col-sm-3 control-label">Lastname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_lastname" name="lastname">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_password" class="col-sm-3 control-label">Password</label>

                    <div class="col-sm-9">
                      <input type="password" class="form-control" id="edit_password" name="password">
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
              <form class="form-horizontal" id="deleteVoter" method="POST" action="">
                {{ csrf_field() }}
                <input type="hidden" class="id" name="id">
                <div class="text-center">
                    <p>DELETE VOTER</p>
                    <h2 class="bold fullname"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Update Photo -->
<div class="modal fade" id="edit_photo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><span class="fullname"></span></b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" id="updateVoterPhoto" method="POST" action="" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" class="id" name="id">
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Photo</label>

                    <div class="col-sm-9">
                      <input type="file" id="photo" name="photo" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="upload"><i class="fa fa-check-square-o"></i> Update</button>
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
  $(document).on('click', '.photo', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

 

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: '{{url('admin/getVoter')}}',
    data: {
        "_token": "{{ csrf_token() }}",
        "id": id
        },
    dataType: 'json',
    success: function(response){
      $('.id').val(response.id);
      $('#edit_email').val(response.email);
      $('#edit_firstname').val(response.firstname);
      $('#edit_lastname').val(response.lastname);
      $('#edit_password').val(response.password);
      $('.fullname').html(response.firstname+' '+response.lastname);
    }
  });
}

    $('body').delegate('#submitVoter', 'submit', function(e){
      e.preventDefault();
      var formData = new FormData(this);

      $.ajax({
      type : "POST",
      url : "{{ url('admin/create_voter') }}",
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

    $('body').delegate('#updateVoter', 'submit', function(e){
      e.preventDefault();
      var formData = new FormData(this);

      $.ajax({
      type : "POST",
      url : "{{ url('admin/update_voter') }}",
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

    

    $('body').delegate('#deleteVoter', 'submit', function(e){
      e.preventDefault();
      var formData = new FormData(this);

      $.ajax({
      type : "POST",
      url : "{{ url('admin/delete_voter') }}",
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

    $('body').delegate('#updateVoterPhoto', 'submit', function(e){
      e.preventDefault();
      var formData = new FormData(this);

      $.ajax({
      type : "POST",
      url : "{{ url('admin/update_voter_photo') }}",
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

