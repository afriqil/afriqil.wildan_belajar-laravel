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
                @if(Session::has('success_message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>success</strong> {{Session::get('success_message')}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @endif
                <form name="subadminform" id="subadminForm" action="{{ url('admin/update-role/'.$id) }}" method="post">@csrf
                  <input disabled="" type="hidden" name="subadmin_id" value="{{ $id }}">
                  @if (!empty($subadminRoles))
                  @foreach($subadminRoles as $role)

                  <!-- Sub Admin CMS Pages -->
                  @if($role['module']=="cms_pages")
                  <!-- Akses Tampil -->
                  @php $viewCMSPages = ($role['view_access'] == 1) ? "checked" : "" @endphp

                  <!-- Akses Edit -->
                  @php $editCMSPages = ($role['edit_access'] == 1) ? "checked" : "" @endphp

                  <!-- Akses Penuh -->
                  @php $fullCMSPages = ($role['full_access'] == 1) ? "checked" : "" @endphp
                  @endif

                  <!-- Sub Admin categories -->
                  @if($role['module']=="categories")
                  <!-- Akses Tampil -->
                  @php $viewCategories = ($role['view_access'] == 1) ? "checked" : "" @endphp

                  <!-- Akses Edit -->
                  @php $editCategories = ($role['edit_access'] == 1) ? "checked" : "" @endphp

                  <!-- Akses Penuh -->
                  @php $fullCategories = ($role['full_access'] == 1) ? "checked" : "" @endphp
                  @endif

                  @endforeach
                  @endif

                  <div class="card-body">
                    <div class="form-group col-md-6">
                      <label for="cms_pages">CMS Pages: &nbsp;&nbsp;</label>
                      <input type="checkbox" name="cms_pages[view]" value="1" @if(isset($viewCMSPages)) {{ $viewCMSPages }} @endif>&nbsp; View Access &nbsp;&nbsp;&nbsp;&nbsp;
                      <input type="checkbox" name="cms_pages[edit]" value="1" @if(isset($editCMSPages)) {{ $editCMSPages }} @endif>&nbsp; View/Edit Access &nbsp;&nbsp;&nbsp;&nbsp;
                      <input type="checkbox" name="cms_pages[full]" value="1" @if(isset($fullCMSPages)) {{ $fullCMSPages }} @endif>&nbsp; Full Access &nbsp;&nbsp;&nbsp;&nbsp;
                    </div>

                    <div class="form-group col-md-6">
                      <label for="categories">Categories: &nbsp;&nbsp;</label>
                      <input type="checkbox" name="cms_pages[view]" value="1" @if(isset($viewCategories)) {{ $viewCategories }} @endif>&nbsp; View Access &nbsp;&nbsp;&nbsp;&nbsp;
                      <input type="checkbox" name="cms_pages[edit]" value="1" @if(isset($editCategories)) {{ $editCategories }} @endif>&nbsp; View/Edit Access &nbsp;&nbsp;&nbsp;&nbsp;
                      <input type="checkbox" name="cms_pages[full]" value="1" @if(isset($fullCategories)) {{ $fullCategories }} @endif>&nbsp; Full Access &nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
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