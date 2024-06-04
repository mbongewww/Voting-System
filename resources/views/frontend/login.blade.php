
@include('frontend.header')
<body class="hold-transition login-page">
<div class="login-box">
  	<div class="login-logo">
  		<b>Voting System</b>
  	</div>
  
  	<div class="login-box-body">
    	<p class="login-box-msg">Sign in to start your session</p>

    	<form action="" id="loginVoter" method="POST">
            {{ csrf_field() }}
      		<div class="form-group has-feedback">
        		<input type="text" class="form-control" name="voter_id" placeholder="Voter's ID" required>
        		<span class="glyphicon glyphicon-user form-control-feedback"></span>
      		</div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
      		<div class="row">
    			<div class="col-xs-4">
          			<button type="submit" class="btn btn-primary btn-block btn-flat" name="login"><i class="fa fa-sign-in"></i> Sign In</button>
        		</div>
      		</div>
    	</form>
  	</div>
  	
</div>
	
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Data Table Initialize -->
<script>

$('body').delegate('#loginVoter', 'submit', function(e){
      e.preventDefault();
      var formData = new FormData(this);

      $.ajax({
      type : "POST",
      url : "{{ url('/login_voter') }}",
      processData: false,
      contentType: false,
      data: formData,
      dataType : "json",
      success: function(data)
      {
          if(data.status == true){
            //   location.reload();
             window.location.href = data.url;
            //alert(data.message)
          }

      },
      error: function(data){
        if(data.status == false){
            //   location.reload();
            // window.location.href = data.url;
            alert(data.message)
          }
        
      }
    });

    });

  $(function () {
    $('#example1').DataTable()
  	var bookTable = $('#booklist').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : false,
      'autoWidth'   : false
    })

    $('#searchBox').on('keyup', function(){
    	bookTable.search(this.value).draw();
	});

  })
</script>
</body>
</html>