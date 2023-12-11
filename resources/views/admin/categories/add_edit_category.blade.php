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
            <li class="breadcrumb-item active">{{ $title }}</li>
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

              <form name="categoryform" id="categoryForm" @if (empty($category['id'])) action="{{ url('admin/add-edit-category') }}" @else action='{{ url('admin/add-edit-category/'.$category['id']) }}' @endif method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="category_name">Category Name*</label>
                    <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Enter Category Name" @if(!empty($category['category_name'])) value="{{$category['category_name']}}" @else value="{{ old('category_name') }}" @endif>
                  </div>
                  <div class="form-group">
                    <label for="category_name">Category Level (Parent Category)*</label>
                    <select name="parent_id" class="form-control">
                      <option value="">Select</option>
                      <option value="0" @if($category['parent_id']==0) selected="" @endif>Main Category</option>
                      @foreach ($getCategories as $cat)
                      <option @if(isset($category['parent_id']) &&$category['parent_id']==$cat['id']) selected @endif value="{{ $cat['id']}}">
                        {{ $cat['category_name']}}
                      </option>
                      @if(!empty($cat['subcategories']))
                      @foreach($cat['subcategories'] as $subcat)
                      <option value="{{ $subcat['id'] }}" @if(isset($category['parent_id']) &&$category['parent_id']==$subcat['id']) selected @endif>
                        &nbsp;&nbsp;&raquo;&raquo;{{ $subcat['category_name'] }}
                      </option>
                      @if(!empty($subcat['subcategories']))
                      @foreach($subcat['subcategories'] as $subsubcat)
                      <option value="{{ $subsubcat['id'] }}">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;{{ $subsubcat['category_name'] }}
                      </option>
                      @endforeach
                      @endif
                      @endforeach
                      @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="category_image">Category Image</label>
                    <input type="file" class="form-control" id="category_image" name="category_image" placeholder="Enter Category Image">
                    @if(!empty($category['category_image']))
                    <a target="_blank" href="{{ url('front/images/categories/'.$category['category_image']) }}">
                      <img src="{{ asset('front/images/categories/'.$category['category_image'] ) }}" alt="Product gambar" style="width:50px; margin: 10px;">
                    </a>
                    &nbsp;&nbsp;
                    <a style="color:#B22222" class="confirmDelete" title="Delete category image" href="javascrip:void(0)" record="category-image" recordid="{{ $category['id'] }}">
                      <i class="fas fa-trash"></i>
                    </a>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="category_discount">Category Discount</label>
                    <input type="text" class="form-control" id="category_discount" name="category_discount" placeholder="Enter Category Discount" @if(!empty($category['category_discount'])) value="{{$category['category_discount']}}" @else value="{{ old('category_discount') }}" @endif>
                  </div>
                  <div class="form-group">
                    <label for="url">Category URL*</label>
                    <input type="text" class="form-control" name="url" id="url" placeholder="Enter Categoy URL" @if(!empty($category['url'])) value="{{$category['url']}}" @else value="{{ old('url') }}" @endif>
                  </div>
                  <div class="form-group">
                    <label for="meta_title">Meta Title</label>
                    <input type="text" class="form-control" name="meta_title" id="meta_title" placeholder="Enter Category Meta Title" @if(!empty($category['meta_title'])) value="{{$category['meta_title']}}" @else value="{{ old('meta_title') }}" @endif>
                  </div>
                  <div class="form-group">
                    <label for="description">Category Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter Your Description"> @if(!empty($category['description'])) {{$category['description']}}  @else {{ old('description') }} @endif</textarea>
                  </div>
                  <div class="form-group">
                    <label for="meta_description">Meta Description</label>
                    <input type="text" class="form-control" name="meta_description" id="meta_description" placeholder="Enter Category Meta Description" @if(!empty($category['meta_description'])) value="{{$category['meta_description']}}" @else value="{{ old('meta_description') }}" @endif>
                  </div>
                  <div class="form-group">
                    <label for="meta_keywords">Meta Keywords</label>
                    <input type="text" class="form-control" name="meta_keywords" id="meta_keywords" placeholder="Enter Category Meta Keywords" @if(!empty($category['meta_keywords'])) value="{{$category['meta_keywords']}}" @else value="{{ old('meta_keywords') }}" @endif>
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