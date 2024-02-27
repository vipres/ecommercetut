@extends('admin.layout.layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Settings</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Update Admin Password</li>
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
                <!-- left column -->
                <div class="col-md-6">
                  <!-- general form elements -->
                  <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Update Password</h3>
                    </div>
                    <!-- /.card-header -->
                  @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if (session('error_message'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error</strong>
                        {{ session('error_message') }}

                    </div>
                    @endif
                    @if (session('success_message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Done</strong>
                        {{ session('success_message') }}

                    </div>
                    @endif
                    <!-- form start -->
                    <form method="post" action="{{ route('admin.update-password') }}" >
                        @csrf
                      <div class="card-body">
                        <div class="form-group">
                          <label for="admin_email">Email address</label>
                          <input class="form-control" id="admin_email" value="{{ Auth::guard('admin')->user()->email }}" readonly style="background-color: #666">
                        </div>
                        <div class="form-group">
                          <label for="current_password">Current Password</label>
                          <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Current Password" required>
                          <span id="verifyCurrentPassword"></span>
                        </div>
                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                        </div>
                      </div>
                      <!-- /.card-body -->

                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </form>
                  </div>
                  <!-- /.card -->




                </div>
                <!--/.col (left) -->

              </div>
              <!-- /.row -->
            </div><!-- /.container-fluid -->
          </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
