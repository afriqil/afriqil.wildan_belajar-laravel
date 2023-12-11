<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use Intervention\Image\ImageManagerStatic as Image;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Models\AdminsRole;


class AdminController extends Controller
{
    public function dashboard()
    {
        session()->put('pages', 'dashboard');
        // echo "<prev>"; print_r(Auth::guard('admin')->user()); die;
        return view('admin.dashboard');
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required|max:30'
            ];

            $customMessages = [
                'email.required' => "Email is required",
                'email.email' => "Valid Email is required",
                'password.required' => "Password is required"
            ];

            $this->validate($request, $rules, $customMessages);


            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {

                // Rember Admin Email and Password
                if (isset($data['remember']) && !empty($data['remember'])) {
                    setcookie("email", $data['email'], time() + 3600);
                    setcookie("password", $data['password'], time() + 3600);
                } else {
                    setcookie("email", "");
                    setcookie("password", "");
                }

                return redirect("admin/dashboard");
            } else {
                return redirect()->back()->with("error_message", "Email atau Password tidak valid!");
            }
        }

        return view('admin.login');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

    public function updatePassword(Request $request)
    {
        session()->put('pages', 'update-password');
        if ($request->isMethod('post')) {
            $data = $request->all();
            if (Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)) {
                if ($data['new_pwd'] == $data['confirm_pwd']) {
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' => bcrypt($data['new_pwd'])]);
                    return redirect()->back()->with('success_message', 'Password has been updated succesfully');
                } else {
                    return redirect()->back()->with('error_message', 'New Password and retype Password not Match');
                }  # code...
            } else {
                return redirect()->back()->with('error_message', 'you current password is Incorrect!');
            }
        }
        return view('admin.update_password');
    }


    public function checkCurrentPassword(Request $request)
    {
        $data = $request->all();
        if (Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)) {
            return "true";
        } else {
            return "false";
        }
    }

    public function updateDetails(Request $request)
    {
        session()->put('pages', 'update-details');
        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'admin_name' => 'required|max:255',
                'admin_mobile' => 'required|numeric|digits:10',
                'admin_image' => 'image',
            ];

            $customMessages = [
                'admin_name.required' => "Name is required",
                'admin_name.max' => "Valid Name is required",
                'admin_mobile.required' => "Mobile is required",
                'admin_mobile.numeric' => "Valid Mobile is required",
                'admin_mobile.digits' => "Valid Mobile is required",
                'admin_image.image' => "Valid Image is required",
            ];

            $this->validate($request, $rules, $customMessages);

            // uplod Admin image
            if ($request->hasFile('admin_image')) {
                $image_tmp = $request->file('admin_image');
                if ($image_tmp->isValid()) {
                    // get image ectension
                    $extension =    $image_tmp->getClientOriginalExtension();
                    // generate new image name
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $image_Path = 'AdminLTE/dist/img/photos/' . $imageName;
                    Image::make($image_tmp)->save($image_Path);
                }
            } else if (!empty($data['current_image'])) {
                $imageName = $data['current_image'];
            } else {
                $imageName = "";
            }

            // this is update admin details
            Admin::where('email', Auth::guard('admin')->user()->email)->update(['name' => $data['admin_name'], 'mobile' => $data['admin_mobile'], 'image' => $imageName]);

            return redirect()->back()->with('success_message', 'Admin Details has been updated succesfully');
        }
        return view('admin.update_details');
    }

    public function subadmins()
    {
        session()->put('pages', 'subadmins');
        $subadmins = Admin::where('type', 'subadmin ')->get();
        return view('admin.subadmins.subadmins')->with(compact('subadmins'));
    }

    public function updateAdminStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Admin::where('id', $data['subadmin_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'subadmin_id' => $data['subadmin_id']]);
        }
    }

    public function deleteSubadmin($id)
    {
        // Delete Sub Admin
        Admin::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Sub Admin berhasil dihapus');
    }

    // Edit Sub Admin

    public function addEditSubadmin(Request $request, $id = null)
    {
        session()->put('pages', 'cms-pages', );
        if ($id == "") {
            $title = "Tambah Sub Admin";
            $subadmindata = new Admin;
            $message = "Halaman SubAdmin berhasil ditambahkan";
        } else {
            $title = "Edit Sub Admin";
            $subadmindata = Admin::find($id);
            $message = "Halaman CMS SubAdmin diperbarui";
        }



        if ($request->isMethod('post')) {
            $data = $request->all();
            if ($id == "") {
                $subadminCount = Admin::where('email', $data['email'])->count();
                if ($subadminCount > 0) {
                    return redirect()->back()->with('error_message', 'Sub Admin already exists');
                }
            }
            $rules = [
                'name' => 'required',
                'mobile' => 'required|numeric',
                'image' => 'image',
            ];
            $customMessages = [
                'name.required' => 'Nama Halaman diperlukan',
                'mobile.required' => 'Mobile diperlukan',
                'mobile.numeric' => 'Valid Mobile diperlukan',
                'image.image' => 'Gambar diperlukan',
            ];
            $this->validate($request, $rules, $customMessages);

            // uplod Admin image
            if ($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    // get image ectension
                    $extension =    $image_tmp->getClientOriginalExtension();
                    // generate new image name
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $image_Path = 'AdminLTE/dist/img/photos/' . $imageName;
                    Image::make($image_tmp)->save($image_Path);
                }
            } else if (!empty($data['current_image'])) {
                $imageName = $data['current_image'];
            } else {
                $imageName = "";
            }

            $subadmindata->image = $imageName;
            $subadmindata->name = $data['name'];
            $subadmindata->mobile = $data['mobile'];
            if ($id == "") {
                $subadmindata->email = $data['email'];
                $subadmindata->type = 'subadmin';
            }
            if ($data['password'] != "") {
                $subadmindata->password = bcrypt($data['password']);
            }
            $subadmindata->save();
            return redirect('admin/subadmins')->with('success_message', $message);
        }
        return view('admin.subadmins.add_edit_subadmin')->with(compact('title', 'subadmindata'));
    }

    public function updateRole($id, Request $request)
    {

        if ($request->isMethod('post')) {
            $data = $request->all();


            // Delete all earlier roles for subadmin
            AdminsRole::where('subadmin_id', $id)->delete();
            // add new roles for Subadmins dynamically
            foreach ($data as $key => $value) {
                if (isset($value['view'])) {
                    $view = $value['view'];
                } else {
                    $view = 0;
                }
                if (isset($value['edit'])) {
                    $edit = $value['edit'];
                } else {
                    $edit = 0;
                }
                if (isset($value['full'])) {
                    $full = $value['full'];
                } else {
                    $full = 0;
                }
            }

            $role = new AdminsRole;
            $role->subadmin_id = $id;
            $role->module = $key ;
            $role->view_access = $view;
            $role->edit_access = $edit;
            $role->full_access = $full;
            $role->save();


            $message = "Subadmin Roles Updated Successfuly";
            return redirect()->back()->with('success_message', $message);
        }

        $subadminRoles = AdminsRole::where('subadmin_id', $id)->get()->toArray();
        $subadminDetails = Admin::where('id',$id)->first()->toArray();
        $title = "Update " .$subadminDetails ['name']. " Subadmin Roles/Permission";
        // dd($subadminRoles);

        return view('admin.subadmins.update_roles')->with(compact('title', 'id', 'subadminRoles'));
    }
}
