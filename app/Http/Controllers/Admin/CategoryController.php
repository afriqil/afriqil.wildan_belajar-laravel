<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Session;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\AdminsRole;

class CategoryController extends Controller
{
    public function categories()
    {
        session()->put('pages', 'categories');
        $categories = Category::with('parentcategory')->get();

        // set admin/subadmin permission for categories
        $categoriesModuleCount = AdminsRole::where(['subadmin_id' =>Auth::guard('admin')->user()->id, 'module'=>'categories'])->count();
        $categoriesModule = array();
        if(Auth::guard('admin')->user()->type=="admin") {
            $categoriesModule['view_access'] = 1;
            $categoriesModule['edit_access'] = 1;
            $categoriesModule['full_access'] = 1;
        }else if($categoriesModuleCount==0) {
            $message = "This features is restricted for you!";
            return redirect('admin/dashboard')->with('error_message', $message);
        }else {
            $categoriesModule = AdminsRole::where(['subadmin_id'=>Auth::guard('admin')->user()->id, 'module'=>'categories'])->first()->toArray();
        }

        return view('admin.categories.categories')->with(compact('categories', 'categoriesModule'));
    }

    public function updateCategoryStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Category::where('id', $data['category_id'])->updateCategoryStatus(['status' => $status]);
            return response()->json(['status' => $status, 'category_id' => $data['category_id']]);
        }
    }


    public function deleteCategory($id)
    {
        // Delete category
        Category::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'category berhasil dihapus');
    }


// ----------------------------------

    public function addEditCategory(Request $request, $id = null)
    {
        $getCategories = Category::getCategories();
        if ($id == "") {
            // add category
            $title = "Add Category";
            $category = new Category;
            $message = "berhasil menambahkan gambar";
        } else {
            // edit category
            $title = "Edit Category";
            $category = Category::find($id);
            $message = "Category berhasil diperbaharui";
        }
        if ($request->isMethod('post')) {
            $data = $request->all();

        if ($id==""){
            $rules = [
                'category_name' => 'required',
                'url' => 'required | unique:categories',
            ];
        }else{
            $rules = [
                'category_name' => 'required',
                'url' => 'required',
            ];
        }

            $customMessages = [
                'category_name.required' => 'Nama kategori harus diisi',
                'url.required' => 'URL kategori harus diisi',
                'url.unique' => 'URL kategori harus diisi unik',
            ];

            $this->validate ($request, $rules, $customMessages);

            // uplod category image
            if ($request->hasFile('category_image')) {
                $image_tmp = $request->file('category_image');
                if ($image_tmp->isValid()) {
                    // get image ectension
                    $extension =    $image_tmp->getClientOriginalExtension();
                    // generate new image name
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $image_Path = 'front/images/categories/' . $imageName;
                    // upload the category image
                    Image::make($image_tmp)->save($image_Path);
                    $category->category_image = $imageName;
                }
            }else {
                $category->category_image = "";
            }

            if(empty($data['category_discount'])) {
                    $data['category_discount'] = 0;
            }

            $category->category_name = $data['category_name'];
            $category->parent_id = $data['parent_id'];
            $category->category_discount = $data['category_discount'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keywords = $data['meta_keywords'];
            $category->status = 1;
            $category->save();
            return redirect('admin/categories')->with('success_message', $message);
        }

        return view('admin.categories.add_edit_category')->with(compact('title', 'getCategories', 'category'));
    }

    public function deleteCategoryImage ($id) {
        // get category image
        $categoryImage = Category::select('category_image')->where('id', $id)->first();

        // Get category image path
        $category_image_path =  'front/images/categories/';

        // delete category image from categories foler if exixst
        if(file_exists($category_image_path.$categoryImage->category_image)) {
            unlink($category_image_path.$categoryImage->category_image);
        }

        // delete category image from categories table
        Category::where('id', $id)-> update(['category_image'=> '']);

        return redirect() ->back()->with('success_message', 'category image deleted successfully');
    }
}
