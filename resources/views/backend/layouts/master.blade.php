<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('public/backend/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('public/backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('public/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('public/backend/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('public/backend/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('public/backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('public/backend/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('public/backend/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('public/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

  <!-- jQuery -->
<script src="{{ asset('public/backend/plugins/jquery/jquery.min.js') }}"></script>
<style type="text/css">
    .notifyjs-corner{
        z-index:1000!important;
    }
</style>
<!-------Notify---->
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.js"></script>
<!-------Sweet Alert-------->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-------Date Picker-------->
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<!----------handlebars----->
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js" integrity="sha512-zT3zHcFYbQwjHdKjCu6OMmETx8fJA9S7E6W7kBeFxultf75OPTYUJigEKX58qgyQMi1m1EgenfjMXlRZG8BXaw==" crossorigin="anonymous"></script>
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('public/backend')}}/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{asset('public/backend')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

@include('backend.layouts.header')
@include('backend.layouts.sidebar')
@yield('content')

@include('backend.layouts.footer')


@if(session()->has('success'))
    <script type="text/javascript">
        $(function(){
        $.notify("{{session()->get('success')}}",{globalPosition:'top right',className:'success'});
        });
    </script>
@endif

@if(session()->has('error'))
    <script type="text/javascript">
        $(function(){
        $.notify("{{session()->get('error')}}",{globalPosition:'top right',className:'error'});
        });
    </script>
@endif


<!----------handlebars----->
<script src="{{ asset('public/backend/dist/js/handlebars.min.js') }}"></script>

<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('public/backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('public/backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('public/backend/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('public/backend/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('public/backend/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('public/backend/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('public/backend/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('public/backend/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('public/backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('public/backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('public/backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('public/backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('public/backend/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('public/backend/dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('public/backend/dist/js/pages/dashboard.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('public/backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<!-- jquery-validation -->
<script src="{{ asset('public/backend/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('public/backend/plugins/jquery-validation/additional-methods.min.js') }}"></script>
<!-- Select2 -->
<script src="{{asset('public/backend')}}/plugins/select2/js/select2.full.min.js"></script>


<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<!-------sweet alert delete------->
<script type="text/javascript">
    $(function(){
        $(document).on('click','#delete',function(e){
            e.preventDefault();
            var link = $(this).attr("href");
            Swal.fire({
              title: 'Are you sure?',
              text: "Delete this data!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.isConfirmed) {
                  window.location.href = link;
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted successfully.',
                  'success'
                )
              }
            });
        });
    });
</script>
<!-------sweet alert Approve------->
<script type="text/javascript">
    $(function(){
        $(document).on('click','#approveBtn',function(e){
            e.preventDefault();
            var link = $(this).attr("href");
            Swal.fire({
              title: 'Are you sure?',
              text: "Approve this data!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, approve it!'
            }).then((result) => {
              if (result.isConfirmed) {
                  window.location.href = link;
                Swal.fire(
                  'Approved!',
                  'Your file has been approve successfully.',
                  'success'
                )
              }
            });
        });
    });
</script>

<!------ShowImage---->
<script type="text/javascript">
  $(document).ready(function(){
    $('#image').change(function(e){
      var reader = new FileReader();
      reader.onload = function(e){
        $('#showImage').attr('src',e.target.result);
      }
      reader.readAsDataURL(e.target.files['0']);
    });
  });
</script>

<script>
    $(function () {
    $('.select2').select2()
    })
</script>

</body>
</html>
