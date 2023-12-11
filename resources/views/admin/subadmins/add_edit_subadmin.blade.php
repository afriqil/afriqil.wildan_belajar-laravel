  @include('admin.layouts.header');
  @include('admin.layouts.loading');
  @include('admin.layouts.navbar');
  @include('admin.layouts.sidebar');
  @include('admin.layouts.footer');

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ $title }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Sub Admin</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">

        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
                @endif
                @if(Session::has('error_message'))
                <div class="alert alert-danfer alert-dismissible fade show" role="alert">
                  <strong>Error!</strong> {{Session::get('success_message')}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @endif
                <form name="subadminform" id="subadminForm" @if (empty($subadmindata['id'])) action="{{url('admin/add-edit-subadmin')}}" @else action="{{url('admin/add-edit-subadmin/'.$subadmindata['id'])}}" @endif method="post" enctype="multipart/form-data">@csrf
                  <class="card-body">
                    <div class="form-group col-md-6">
                      <label for="name">Name*</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama Sub Admin" @if(!empty($subadmindata['name'])) value="{{$subadmindata['name']}}" @endif>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="mobile">Mobile*</label>
                      <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Enter Sub Admin Mobile" @if(!empty($subadmindata['mobile'])) value="{{ $subadmindata['mobile']}}" @endif>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="email">Email*</label>
                      <input @if($subadmindata['id'] !="" ) disabled="" @else required="" @endif type="email" class="form-control" name="email" id="email" placeholder="Enter Email" @if(!empty($subadmindata['email'])) value="{{ $subadmindata['email']}}" @else value="{{ old('name') }}" @endif>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="password">Password</label>
                      <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" @if(!empty($subadmindata['password'])) value="{{ $subadmindata['password']}}" @endif>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="image">Image</label>
                      <input type="file" class="form-control" id="image" name="image">
                      @if(!empty($subadmindata['image']))
                      <a target="_blank" href="{{ url('AdminLTE/dist/img/photos/'.$subadmindata['image']) }}">View Foto </a>
                      <input type="hidden" name="current_image" value="{{ $subadmindata['image'] }}">
                      @endif
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer col-md-6">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
                <!-- /.form-group -->
              </div>
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
            the plugin.
          </div>
        </div>
      </div>
  </div>
  </div>
  </section>


  </div>