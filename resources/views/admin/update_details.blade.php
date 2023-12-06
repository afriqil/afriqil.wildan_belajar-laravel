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
            <li class="breadcrumb-item"><a href="#">Update Admin Details</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <div class="col-md-6">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Update Admin Details</h3>
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

      @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <form class="p-4" method="post" action="{{url('admin/update-details')}}" enctype="multipart/form-data">@csrf
        <div class="form-group">
          <label for="admin_email">Email address</label>
          <input class="form-control" id="admin_email" placeholder="Enter email" value="{{Auth::guard('admin')->user()->email}}" readonly="" style="background-color: #666;">
        </div>
        <div class="form-group">
          <label for="admin_name">Admin Name</label>
          <input type="text" class="form-control" id="admin_name" name="admin_name" placeholder="Admin Name" value="{{Auth::guard('admin')->user()->name}}">
        </div>
        <div class="form-group">
          <label for="admin_mobile">Mobile</label>
          <input type="text" class="form-control" id="admin_mobile" name="admin_mobile" placeholder="Mobile" value="{{Auth::guard('admin')->user()->mobile}}">
        </div>
        <div class="form-group">
          <label for="admin_image">Image</label>
          <input type="file" class="form-control" id="admin_image" name="admin_image">
            @if(!empty(Auth::guard('admin')->user()->image))
            <a target="_blank" href="{{ url('AdminLTE/dist/img/photos/'.Auth::guard('admin')->user()->image)}}">View Foto</a>
            <input type="hidden" value="{{Auth::guard('admin')->user()->image}}" name="current_image">
            @endif
        </div>

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>