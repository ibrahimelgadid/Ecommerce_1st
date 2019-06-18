<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    public function index(){
        $products = DB::table('tbl_products')
        ->join('tbl_category', 'tbl_products.category_id', '=', 'tbl_category.category_id')
        ->join('tbl_manufature', 'tbl_products.manufacture_id', '=', 'tbl_manufature.manufacture_id')
        ->select('tbl_products.*', 'tbl_manufature.manufacture_name','tbl_category.category_name')
        ->where('tbl_products.publication_status', 1)
        ->get();
        return view('pages.home_conent')->with('products', $products);
    }

    public function product_by_category($category_id){

        $products = DB::table('tbl_products')
        ->join('tbl_category', 'tbl_products.category_id', '=', 'tbl_category.category_id')
        ->join('tbl_manufature', 'tbl_products.manufacture_id', '=', 'tbl_manufature.manufacture_id')
        ->select('tbl_products.*', 'tbl_manufature.manufacture_name','tbl_category.category_name')
        ->where('tbl_category.category_id', $category_id)
        ->where('tbl_products.publication_status', 1)
        ->get();
        return view('pages.product_by_category')->with('products', $products);
    }

    public function product_by_manufacture($manufacture_id){

        $products = DB::table('tbl_products')
        ->join('tbl_category', 'tbl_products.category_id', '=', 'tbl_category.category_id')
        ->join('tbl_manufature', 'tbl_products.manufacture_id', '=', 'tbl_manufature.manufacture_id')
        ->select('tbl_products.*', 'tbl_manufature.manufacture_name','tbl_category.category_name')
        ->where('tbl_manufature.manufacture_id', $manufacture_id)
        ->where('tbl_products.publication_status', 1)
        ->get();
        return view('pages.product_by_manufacture')->with('products', $products);
    }


    public function view_product($product_id){
        $product = DB::table('tbl_products')
        ->join('tbl_category', 'tbl_products.category_id', '=', 'tbl_category.category_id')
        ->join('tbl_manufature', 'tbl_products.manufacture_id', '=', 'tbl_manufature.manufacture_id')
        ->select('tbl_products.*', 'tbl_manufature.manufacture_name','tbl_category.category_name')
        ->where('tbl_products.publication_status', 1)
        ->where('tbl_products.product_id', $product_id)
        ->first();
        return view('pages.view_product')->with('product', $product);
    }
}
