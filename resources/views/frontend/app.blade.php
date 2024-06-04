
@include('frontend.header')
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	@include('frontend.navbar')
	 
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	      	
	      	<h1 class="page-header text-center title"><b>student voting System</b></h1>
	        <div class="row">
	        	<div class="col-sm-10 col-sm-offset-1">
	        	
                    
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
		
 
				    <div class="alert alert-danger alert-dismissible" id="alert" style="display:none;">
		        		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			        	<span class="message"></span>
			        </div>

				    	@if(!empty($checkIfHasVoted->count()))
				    		
				    		<div class="text-center">
					    		<h3>You have already voted for this election.</h3>
					    		
					    	</div>
                            <h2 class="text-center">list of your Candidtates and their position</h2>
							@foreach($checkCand as $check)
							<div class="text-center">
								
					    		<h3>{{$check->pname}}: {{$check->canfname}} {{$check->canlname}} </h3>
					    		{{-- <p>{{$check->canfname}} {{$check->canlname}} </p> --}}
								
					    	</div>
                             
							@endforeach
				  
				    	
				    	@else
								
						
			    			<!-- Voting Ballot -->
						    <form method="POST" id="ballotForm" action="">
								{{ csrf_field() }}
								
								@foreach($getPositions as $position)
									
					
									<div class="row">
										<div class="col-xs-12">
											<div class="box box-solid" id="{{$position->id}}">
												<div class="box-header with-border">
													<h3 class="box-title"><b>{{$position->position}}</b></h3>
												</div>
												<div class="box-body">
													{{-- <span class="pull-right">
														<button type="button" class="btn btn-success btn-sm btn-flat reset" data-desc="{{$position->position}}"><i class="fa fa-refresh"></i>Reset</button>
													</span> --}}
													<p>please select one candidate</p>
													@foreach($position->getCandidates() as $candidate )
													
													@php
													    $checked = '';
													     if($position->id == $candidate->position_id){
															$checked = 'checked';
														 }
													@endphp
												
													<p> 
														
													</p>
													  <div id="candidate_list">
														<ul>
															<li>
																
																@if($position->maximum_vote > 1)
																<input type="checkbox" class="flat-red{{$position->position}}" name="{{$position->position}}[]" value="{{$candidate->id}}">
																@else
																<input type="radio" class="flat-red{{$position->position}}" name="{{$position->position}}" value="{{$candidate->id}}">       
																@endif
																<button type="button" class="btn btn-primary btn-sm btn-flat clist platform" data-platform="{{$candidate->description}}" data-fullname="{{$candidate->firstname}} {{$candidate->lastname}}"><i class="fa fa-search"></i> Platform</button><img src="{{$candidate->getPhoto()}}" height="100px" width="100px" class="clist"><span class="cname clist">{{$candidate->firstname}} {{$candidate->lastname}}</span>
															</li>
														</ul>
													</div>
												  @endforeach
												
												
											 </div>

											 
											</div>
										</div>
									</div>
									
								@endforeach
				        		<div class="text-center">
					        		
					        		<button type="submit" class="btn btn-primary btn-flat" name="vote"><i class="fa fa-check-square-o"></i> Submit</button>
					        	</div>
				        	</form>
				        	<!-- End Voting Ballot -->
				       @endif
	        	</div>
	        </div>
	      </section>
	     
	    </div>
	  </div>
  
  	@include('frontend.footer')
  	@include('frontend.ballot_modal')
</div>

<script>
		$(function(){
			$('.content').iCheck({
				checkboxClass: 'icheckbox_flat-green',
				radioClass: 'iradio_flat-green'
			});

			$(document).on('click', '.reset', function(e){
				e.preventDefault();
				var desc = $(this).data('desc');
				$('.'+desc).iCheck('uncheck');
			});

			$(document).on('click', '.platform', function(e){
				e.preventDefault();
				$('#platform').modal('show');
				var platform = $(this).data('platform');
				var fullname = $(this).data('fullname');
				$('.candidate').html(fullname);
				$('#plat_view').html(platform);
			});

			$('#preview').click(function(e){
				e.preventDefault();
				var form = $('#ballotForm').serialize();
				if(form == ''){
					$('.message').html('You must vote atleast one candidate');
					$('#alert').show();
				}
				else{
					$.ajax({
						type: 'POST',
						url: '{{ url('/home') }}',
						data: form,
						dataType: 'json',
						success: function(response){
							if(response.error){
								var errmsg = '';
								var messages = response.message;
								for (i in messages) {
									errmsg += messages[i]; 
								}
								$('.message').html(errmsg);
								$('#alert').show();
							}
							else{
								$('#preview_modal').modal('show');
								$('#preview_body').html(response.list);
							}
						}
					});
				}
				
			});

		});
</script>
</body>
</html>