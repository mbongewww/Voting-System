@extends('admin.app')

@section('style')

@endsection

@section('content')
   
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            Dashboard
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
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
    
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
        
                <h3>{{$getPositions->count()}}</h3>
            
            <p>No. of Positions</p>
            </div>
            <div class="icon">
            <i class="fa fa-tasks"></i>
            </div>
            <a href="{{url('admin/positions')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
            
                <h3>{{$getCandidates->count()}}</h3>
            
            <p>No. of Candidates</p>
            </div>
            <div class="icon">
            <i class="fa fa-black-tie"></i>
            </div>
            <a href="{{url('admin/candidates')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$getVoters->count()}}</h3>
            <p>Total Voters</p>
            </div>
            <div class="icon">
            <i class="fa fa-users"></i>
            </div>
            <a href="{{url('admin/voters')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">

            <h3>0</h3>
            
            <p>Voters Voted</p>
            </div>
            <div class="icon">
            <i class="fa fa-edit"></i>
            </div>
            <a href="votes.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
        </div>
        <!-- ./col -->
    </div>

    <div class="row">
        <div class="col-xs-12">
        <h3>Votes Tally
            <span class="pull-right">
            <a href="print.php" class="btn btn-success btn-sm btn-flat"><span class="glyphicon glyphicon-print"></span> Print</a>
            </span>
        </h3>
        </div>
    </div>

    @php
        // $sql = "SELECT * FROM positions ORDER BY priority ASC";
        // $query = $conn->query($sql);
        // $inc = 2;
        // while($row = $query->fetch_assoc()){
        //   $inc = ($inc == 2) ? 1 : $inc+1; 
        //   if($inc == 1) echo "<div class='row'>";
        //   echo "
        //     <div class='col-sm-6'>
        //       <div class='box box-solid'>
        //         <div class='box-header with-border'>
        //           <h4 class='box-title'><b>".$row['description']."</b></h4>
        //         </div>
        //         <div class='box-body'>
        //           <div class='chart'>
        //             <canvas id='".slugify($row['description'])."' style='height:200px'></canvas>
        //           </div>
        //         </div>
        //       </div>
        //     </div>
        //   ";
        //   if($inc == 2) echo "</div>";  
        // }
        // if($inc == 1) echo "<div class='col-sm-6'></div></div>";
    @endphp

    </section>
    <!-- right col -->
    </div>
  
    
@endsection
@section('script')


@endsection

