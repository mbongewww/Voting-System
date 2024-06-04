{{-- @php include 'includes/slugify.php'; @endphp --}}
@include ('admin.header')
  @yield('style')
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include('admin.navbar')
  @include('admin.menubar')

   <!-- Content Wrapper. Contains page content -->
     @yield('content')
   <!-- Content Wrapper. Contains page content -->
  	@include('admin.footer')

</div>
<!-- ./wrapper -->
    <!-- jQuery 3 -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="../plugins/iCheck/icheck.min.js"></script>
    <!-- Moment JS -->
    <script src="../bower_components/moment/moment.js"></script>
    <!-- DataTables -->
    <script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <!-- ChartJS -->
    <script src="../bower_components/chart.js/Chart.js"></script>
    <!-- ChartJS Horizontal Bar -->
    <script src="../bower_components/chart.js/Chart.HorizontalBar.js"></script>
    <!-- daterangepicker -->
    <script src="../bower_components/moment/min/moment.min.js"></script>
    <script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- bootstrap time picker -->
    <script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <!-- Slimscroll -->
    <script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- Active Script -->
    <script>
        

    $('body').delegate('#submitFormUpdate', 'submit', function(e){
        e.preventDefault();
        var formData = new FormData(this);
      
        $.ajax({
        type : "POST",
        url : "{{ url('update_admin') }}",
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
    

    $(function(){
        /** add active class and stay opened when selected */
        var url = window.location;

        // for sidebar menu entirely but not cover treeview
        $('ul.sidebar-menu a').filter(function() {
            return this.href == url;
        }).parent().addClass('active');

        // for treeview
        $('ul.treeview-menu a').filter(function() {
            return this.href == url;
        }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');

    });
    </script>
    <!-- Data Table Initialize -->
    <script>
    $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
        })
    })
    </script>
    <!-- Date and Timepicker -->
    <script>
    $(function(){
    //Date picker
    $('#datepicker_add').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
    })
    $('#datepicker_edit').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
    }) 
    });
    </script>

    <script>
    // $(function(){
    //   var rowid = '1';
    //   var description = '1';
    //   var barChartCanvas = $('#'+description).get(0).getContext('2d')
    //   var barChart = new Chart(barChartCanvas)
    //   var barChartData = {
    //     labels  : ,
    //     datasets: [
    //       {
    //         label               : 'Votes',
    //         fillColor           : 'rgba(60,141,188,0.9)',
    //         strokeColor         : 'rgba(60,141,188,0.8)',
    //         pointColor          : '#3b8bba',
    //         pointStrokeColor    : 'rgba(60,141,188,1)',
    //         pointHighlightFill  : '#fff',
    //         pointHighlightStroke: 'rgba(60,141,188,1)',
    //         data                : 
    //       }
    //     ]
    //   }
    //   var barChartOptions                  = {
    //     //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
    //     scaleBeginAtZero        : true,
    //     //Boolean - Whether grid lines are shown across the chart
    //     scaleShowGridLines      : true,
    //     //String - Colour of the grid lines
    //     scaleGridLineColor      : 'rgba(0,0,0,.05)',
    //     //Number - Width of the grid lines
    //     scaleGridLineWidth      : 1,
    //     //Boolean - Whether to show horizontal lines (except X axis)
    //     scaleShowHorizontalLines: true,
    //     //Boolean - Whether to show vertical lines (except Y axis)
    //     scaleShowVerticalLines  : true,
    //     //Boolean - If there is a stroke on each bar
    //     barShowStroke           : true,
    //     //Number - Pixel width of the bar stroke
    //     barStrokeWidth          : 2,
    //     //Number - Spacing between each of the X value sets
    //     barValueSpacing         : 5,
    //     //Number - Spacing between data sets within X values
    //     barDatasetSpacing       : 1,
    //     //String - A legend template
    //     legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
    //     //Boolean - whether to make the chart responsive
    //     responsive              : true,
    //     maintainAspectRatio     : true
    //   }

    //   barChartOptions.datasetFill = false
    //   var myChart = barChart.HorizontalBar(barChartData, barChartOptions)
    //   //document.getElementById('legend_'+rowid).innerHTML = myChart.generateLegend();
    // });
    </script>
    @yield('script')
</body>
</html>
