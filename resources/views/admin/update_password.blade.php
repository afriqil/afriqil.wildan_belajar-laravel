@include('admin.layouts.header');
@include('admin.layouts.loading');
@include('admin.layouts.navbar');
@include('admin.layouts.sidebar');
@include('admin.layouts.footer');

@section('content')
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Setting Admin</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Update Password Admin</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <div class="col-md-6">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Update Password</h3>
      </div>

      @if(Session::has('error_message'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> {{Session::get('error_message')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
      @if(Session::has('success_message'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>success</strong> {{Session::get('success_message')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif

      <form class="p-4" method="post" action="{{url('admin/update-password')}}">@csrf
        <div class="form-group">
          <label for="admin_email">Email address</label>
          <input class="form-control" id="admin_email" placeholder="Enter email" value="{{Auth::guard('admin')->user()->email}}" style="background-color: #666;">
        </div>
        <div class="form-group">
          <label for="current_pwd">Current Password</label>
          <input type="password" class="form-control" id="current_pwd" name="current_pwd" placeholder="Current Password"> <span id="verivyCurrentPwd"></span>
        </div>
        <div class="form-group">
          <label for="new_pwd">New Password</label>
          <input type="password" class="form-control" id="new_pwd" name="new_pwd" placeholder="New Password">
        </div>
        <div class="form-group">
          <label for="confirm_pwd">Confirm Password</label>
          <input type="password" class="form-control" id="confirm_pwd" name="confirm_pwd" placeholder="Confirm Password">
        </div>

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>