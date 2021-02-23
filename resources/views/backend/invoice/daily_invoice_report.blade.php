@extends('backend.layouts.master')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Invoice</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Invoice</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3>
                                    Select Criteria
                                </h3>
                            </div>
                            <div class="card-body">
                              <form action="{{route('daily-report-pdf')}}" method="GET" target="_blank" id="myForm">
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label>Start Date</label>
                                        <input type="text" class="datepicker" id="start_date" name="start_date" class="form-control" readonly placeholder="dd-mm-yyyy">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>End Date</label>
                                        <input type="text" class="datepicker1" id="end_date" name="end_date" class="form-control" readonly placeholder="dd-mm-yyyy">
                                    </div>
                                    <div class="form-group" style="margin-top: 32px;">
                                       <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> Search</button>
                                    </div>
                                  </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>



    <script>
      $('.datepicker').datepicker({
          uiLibrary: 'bootstrap4',
          format: 'dd-mm-yyyy'
      });
      $('.datepicker1').datepicker({
          uiLibrary: 'bootstrap4',
          format: 'dd-mm-yyyy'
      });
    </script>
    <script>
          $(function () {
              $('#myForm').validate({
                  rules: {
                      start_date: {
                          required: true,
                      },
                      end_date: {
                          required: true,
                      }
                  },
                  messages: {

                  },
                  errorElement: 'span',
                  errorPlacement: function (error, element) {
                      error.addClass('invalid-feedback');
                      element.closest('.form-group').append(error);
                  },
                  highlight: function (element, errorClass, validClass) {
                      $(element).addClass('is-invalid');
                  },
                  unhighlight: function (element, errorClass, validClass) {
                      $(element).removeClass('is-invalid');
                  }
              });
          });
    </script>



@endsection
