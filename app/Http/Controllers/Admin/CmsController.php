<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CmsPage;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;


class CmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        session()->put('pages', 'cms-pages');
        $CmsPages = CmsPage::get()->toArray();
        return view('admin.pages.cms_pages')->with(compact('CmsPages'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CmsPage $cmsPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id = null)
    {
        session()->put('pages', 'cms-pages');
        if ($id == "") {
            $title = "Tambah Halaman CMS";
            $cmspage = new CmsPage;
            $message = "Halaman CMS berhasil ditambahkan";
        } else {
            $title = "Edit Halaman CMS";
            $cmspage = CmsPage::find($id);
            $message = "Halaman CMS berhasil diperbarui";
        }



        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'title' => 'required',
                'url' => 'required',
                'description' => 'required',
            ];
            $customMessages = [
                'title.required' => 'Judul Halaman diperlukan',
                'url.required' => 'URL diperlukan',
                'description.required' => 'Deskripsi diperlukan',
            ];
            $this->validate($request, $rules, $customMessages);

            $data = $request->all(); // Ambil semua data input formulir

            $cmspage = new CmsPage();
            $cmspage->title = $data['title'];
            $cmspage->url = $data['url'];
            $cmspage->description = $data['description'];
            $cmspage->meta_title = $data['meta_title'];
            $cmspage->meta_description = $data['meta_description'];
            $cmspage->meta_keywords = $data['meta_keywords'];
            $cmspage->status = 1;
            $cmspage->save(); // Simpan data
            $CmsPages = CmsPage::get()->toArray();
            return redirect('admin/cms-pages')->with('success_message', $message);

        }

        return view('admin.pages.add_edit_cmspages')->with(compact('title', 'cmspage'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CmsPage $cmsPage)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            CmsPage::where('id', $data['page_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'page_id' => $data['page_id']]);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Delete CMS Page
        CmsPage::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'CMS Page berhasil dihapus');
    }
}
