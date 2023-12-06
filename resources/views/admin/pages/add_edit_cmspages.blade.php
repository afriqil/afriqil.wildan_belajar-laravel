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
            <h1 class="m-0">Add CMS Pages</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add CMS Pages</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">

        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Add CMS Page</h3>

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

                <form name="cmsform" id="cmsForm" @if (empty($cmspage['id'])) action="{{ url('admin/add-edit-cms-pages'.$cmspage['id'])}}" @else @endif method="post">@csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="title">title*</label>
                      <input type="text" class="form-control" id="title" name="title" placeholder="Enter Page Title" @if(!empty($cmspage['title'])) value="{{ $cmspage['title']}}" @endif>
                    </div>
                    <div class="form-group">
                      <label for="url">URL*</label>
                      <input type="text" class="form-control" name="url" id="url" placeholder="Enter Page URL" @if(!empty($cmspage['url'])) value="{{ $cmspage['url']}}" @endif>
                    </div>
                    <div class="form-group">
                      <label for="description">Description*</label>
                      <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter Your Description"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="meta_title">Meta Title</label>
                      <input type="text" class="form-control" name="meta_title" id="meta_title" placeholder="Enter Page Meta Title" @if(!empty($cmspage['meta_title'])) value="{{ $cmspage['meta_title']}}" @endif>
                    </div>
                    <div class="form-group">
                      <label for="meta_description">Meta Description</label>
                      <input type="text" class="form-control" name="meta_description" id="meta_description" placeholder="Enter Page Meta Description" @if(!empty($cmspage['meta_description'])) value="{{ $cmspage['meta_description']}}" @endif>
                    </div>
                    <div class="form-group">
                      <label for="meta_keywords">Meta Keywords</label>
                      <input type="text" class="form-control" name="meta_keywords" id="meta_keywords" placeholder="Enter Page Meta Keywords" @if(!empty($cmspage['meta_keywords'])) value="{{ $cmspage['meta_keywords']}}" @endif>
                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
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