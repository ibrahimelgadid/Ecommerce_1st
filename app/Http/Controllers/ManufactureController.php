<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class ManufactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.add_manufacture');
    }



    public function save_manufacture(Request $request)
    {
         $data = array();

        $data['manufacture_id']= $request->manufacture_id;
        $data['manufacture_name']= $request->manufacture_name;
        $data['manufacture_description']= $request->manufacture_description;
        $data['publication_status']= $request->publication_status?$request->publication_status:0;
        $this->validate($request, [
            'manufacture_name' => 'required|min:2',
            'manufacture_description' => 'required',
        ]);

        DB::table('tbl_manufature')->insert($data);
        $request->session()->flash('success', 'manufacture added successfully');
        return redirect('/all_manufacture');
    }


    public function all_manufacture()
    {
        $manufactures = DB::table('tbl_manufature')
            ->get();
        return view('admin.all_manufacture')->with('manufactures', $manufactures);
    }

   
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

    public function unactive_manufacture(Request $request,$manufacture_id){
        DB::table('tbl_manufature')
            ->where('manufacture_id', $manufacture_id)
            ->update(['publication_status' => 0]);
            $request->session()->flash('success', 'manufacture unactivated successfully');
            return redirect('all_manufacture');
    }


    public function active_manufacture(Request $request,$manufacture_id){
        DB::table('tbl_manufature')
            ->where('manufacture_id', $manufacture_id)
            ->update(['publication_status' => 1]);
            $request->session()->flash('success', 'manufacture activated successfully');
            return redirect('all_manufacture');
    }


    
    public function delete_manufacture($manufacture_id){
        DB::table('tbl_manufature')
        ->where('manufacture_id', $manufacture_id)
        ->delete();
        session()->flash('success', 'manufacture deleted successfully');
        return redirect('/all_manufacture');
    }

    public function edit_manufacture($manufacture_id){
        $manufacture = DB::table('tbl_manufature')
             ->where('manufacture_id', $manufacture_id)
             ->first();
 
             return view('admin.edit_manufacture')->with('manufacture', $manufacture);
     }
 
     public function update_manufacture(Request  $request,$manufacture_id){
         $data = array();
         $data['manufacture_name']= $request->manufacture_name;
         $data['manufacture_description']= $request->manufacture_description;
         $data['publication_status']= $request->publication_status;
         $this->validate($request, [
             'manufacture_name' => 'required|min:2',
             'manufacture_description' => 'required',
         ]);
 
         DB::table('tbl_manufature')
         ->where('manufacture_id', $manufacture_id)
         ->update($data);
         $request->session()->flash('success', 'manufacture updated successfully');
         return redirect('/all_manufacture');
     }
 
}
