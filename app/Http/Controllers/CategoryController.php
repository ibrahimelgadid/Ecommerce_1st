<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class CategoryController extends Controller
{
    public function index(){
        return view('admin.add_category');
    }

    public function all_category(){
        $categories = DB::table('tbl_category')->get();

        return view('admin.all_category')->with('categories',$categories);
    }

    public function save_category(Request $request){
        $data = array();

        $data['category_id']= $request->category_id;
        $data['category_name']= $request->category_name;
        $data['category_description']= $request->category_description;
        $data['publication_status']= $request->publication_status;
        $this->validate($request, [
            'category_name' => 'required|min:2',
            'category_description' => 'required',
        ]);

        DB::table('tbl_category')->insert($data);
        $request->session()->flash('success', 'Category added successfully');
        return redirect('/all_category');
    }


    public function unactive_category($category_id){
        DB::table('tbl_category')
            ->where('category_id', $category_id)
            ->update(['publication_status' => 0]);
            Session::flash('success', 'Category unactivated successfully');
            return redirect('all_category');
    }


    public function active_category($category_id){
        DB::table('tbl_category')
            ->where('category_id', $category_id)
            ->update(['publication_status' => 1]);
            Session::flash('success', 'Category activated successfully');
            return redirect('all_category');
    }


    public function edit_category($category_id){
       $category = DB::table('tbl_category')
            ->where('category_id', $category_id)
            ->first();

            return view('admin.edit_category')->with('category', $category);
    }

    public function update_category(Request  $request,$category_id){
        $data = array();
        $data['category_name']= $request->category_name;
        $data['category_description']= $request->category_description;
        $data['publication_status']= $request->publication_status;
        $this->validate($request, [
            'category_name' => 'required|min:2',
            'category_description' => 'required',
        ]);

        DB::table('tbl_category')
        ->where('category_id', $category_id)
        ->update($data);
        $request->session()->flash('success', 'Category updated successfully');
        return redirect('/all_category');
    }

    public function delete_category($category_id){
        DB::table('tbl_category')
        ->where('category_id', $category_id)
        ->delete();
        session()->flash('success', 'Category deleted successfully');
        return redirect('/all_category');
    }

}


