<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class ProductController extends Controller
{

    
    public function index(){
        $this->AdminAuth();
        $data = array();

        $data['categories'] = DB::table('tbl_category')->get();
        $data['manufactures'] = DB::table('tbl_manufature')->get();
        
        return view('admin.add_product')->with("data", $data);
    }

    public function all_product(){
        $this->AdminAuth();
        $products = DB::table('tbl_products')
                    ->join('tbl_category', 'tbl_products.category_id', '=', 'tbl_category.category_id')
                    ->join('tbl_manufature', 'tbl_products.manufacture_id', '=', 'tbl_manufature.manufacture_id')
                    ->select('tbl_products.*', 'tbl_manufature.manufacture_name','tbl_category.category_name')
                    ->get();

        return view('admin.all_product')->with('products',$products);
    }

    public function save_product(Request $request){
        $data = array();
        
        $data['product_id']= $request->product_id;
        $data['product_name']= $request->product_name;
        $data['product_color']= $request->product_color;
        $data['product_size']= $request->product_size;
        $data['product_price']= $request->product_price;
        $data['category_id']= $request->category_id;
        $data['manufacture_id']= $request->manufacture_id;
        $data['product_short_description']= $request->product_short_description;
        $data['product_long_description']= $request->product_long_description;
        $data['publication_status']= $request->publication_status?$request->publication_status:0;
        $image = $request->file('product_image');

        if($image){
            $imageName = str_random(20);
            $imageExt = strtolower($image->getClientOriginalExtension());
            $imageFullName = $imageName . '.'. $imageExt;
            $uploadPath = 'image/product/';
            $imageUrl = $uploadPath . $imageFullName;
            $success = $image->move($uploadPath, $imageFullName);
            if($success){
                
                $data['product_image'] = $imageUrl;
                // var_dump($data);

                // $this->validate($request, [
                //     'product_name' => 'required|min:2',
                //     'product_long_description' => 'required',
                // ]);


                DB::table('tbl_products')->insert($data);
                $request->session()->flash('success', 'product added successfully');
                return redirect('/all_product');
            }
        }else{
            $data['product_image'] = '';
            // $this->validate($request, [
            //     'product_name' => 'required|min:2',
            //     'product_long_description' => 'required',
            // ]);
    
            DB::table('tbl_products')->insert($data);
            $request->session()->flash('success', 'product added successfully');
            return redirect('/all_product');
            // echo '<pre>';
            // var_dump($data);
            // echo '</pre>';
        }

       
    }


    public function unactive_product(Request $request,$product_id){
        DB::table('tbl_products')
            ->where('product_id', $product_id)
            ->update(['publication_status' => 0]);
            $request->session()->flash('success', 'product unactivated successfully');
            return redirect('all_product');
    }


    public function active_product(Request $request,$product_id){
        DB::table('tbl_products')
            ->where('product_id', $product_id)
            ->update(['publication_status' => 1]);
            $request->session()->flash('success', 'product activated successfully');
            return redirect('all_product');
    }


    public function edit_product($product_id){
        $this->AdminAuth();
       $product = DB::table('tbl_products')
            ->where('product_id', $product_id)
            ->first();

            return view('admin.edit_product')->with('product', $product);
    }

    public function update_product(Request  $request,$product_id){
        $data = array();
        $data['product_name']= $request->product_name;
        $data['product_description']= $request->product_description;
        $data['publication_status']= $request->publication_status;
        $this->validate($request, [
            'product_name' => 'required|min:2',
            'product_description' => 'required',
        ]);

        DB::table('tbl_products')
        ->where('product_id', $product_id)
        ->update($data);
        $request->session()->flash('success', 'product updated successfully');
        return redirect('/all_product');
    }

    public function delete_product($product_id){
        DB::table('tbl_products')
        ->where('product_id', $product_id)
        ->delete();
        session()->flash('success', 'product deleted successfully');
        return redirect('/all_product');
    }

    public function AdminAuth(){
        if(Session::get('admin_name')){
            return;
        }else{
            return redirect('/admin')->with('error','you not admin')->send();
        }
    }
}

