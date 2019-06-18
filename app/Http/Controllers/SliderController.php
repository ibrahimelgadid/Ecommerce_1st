<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;

class SliderController extends Controller
{
    public function index(){
        return view('admin.add_slider');
    }

    public function all_slider(){
        $sliders = DB::table('tbl_slider')->get();

        return view('admin.all_slider')->with('sliders',$sliders);
    }

    public function save_slider(Request $request){
        $data = array();

        $data['slider_id']= $request->slider_id;
        $data['publication_status']= $request->publication_status;
        $image = $request->file('slider_image');

        if($image){
            $imageName = str_random(20);
            $imageExt = strtolower($image->getClientOriginalExtension());
            $imageFullName = $imageName . '.'. $imageExt;
            $uploadPath = 'image/slider/';
            $imageUrl = $uploadPath . $imageFullName;
            $success = $image->move($uploadPath, $imageFullName);
            if($success){
                
                $data['slider_image'] = $imageUrl;
                // var_dump($data);

                // $this->validate($request, [
                //     'slider_name' => 'required|min:2',
                //     'slider_long_description' => 'required',
                // ]);


                DB::table('tbl_slider')->insert($data);
                $request->session()->flash('success', 'slider added successfully');
                return redirect('/all_slider');
            }
        }else{
            $data['slider_image'] = '';
            // $this->validate($request, [
            //     'slider_name' => 'required|min:2',
            //     'slider_long_description' => 'required',
            // ]);
    
            DB::table('tbl_slider')->insert($data);
            $request->session()->flash('success', 'slider added successfully');
            return redirect('/all_slider');
            // echo '<pre>';
            // var_dump($data);
            // echo '</pre>';
        }

        
    }


    public function unactive_slider($slider_id){
        DB::table('tbl_slider')
            ->where('slider_id', $slider_id)
            ->update(['publication_status' => 0]);
            Session::flash('success', 'slider unactivated successfully');
            return redirect('all_slider');
    }


    public function active_slider($slider_id){
        DB::table('tbl_slider')
            ->where('slider_id', $slider_id)
            ->update(['publication_status' => 1]);
            Session::flash('success', 'slider activated successfully');
            return redirect('all_slider');
    }


    public function edit_slider($slider_id){
       $slider = DB::table('tbl_slider')
            ->where('slider_id', $slider_id)
            ->first();

            return view('admin.edit_slider')->with('slider', $slider);
    }

    public function update_slider(Request  $request,$slider_id){
        $data = array();
        $data['slider_name']= $request->slider_name;
        $data['slider_description']= $request->slider_description;
        $data['publication_status']= $request->publication_status;
        $this->validate($request, [
            'slider_name' => 'required|min:2',
            'slider_description' => 'required',
        ]);

        DB::table('tbl_slider')
        ->where('slider_id', $slider_id)
        ->update($data);
        $request->session()->flash('success', 'slider updated successfully');
        return redirect('/all_slider');
    }

    public function delete_slider($slider_id){
        DB::table('tbl_slider')
        ->where('slider_id', $slider_id)
        ->delete();
        session()->flash('success', 'slider deleted successfully');
        return redirect('/all_slider');
    }
}
