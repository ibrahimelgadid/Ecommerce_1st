<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;

class CartController extends Controller
{
    public function add_to_cart(Request $request){
        $qty = $request->qty;
        $product_id = $request->product_id;

        $product = DB::table('tbl_products')
                    ->where('product_id', $product_id)
                    ->first();
        
        $data['qty']=$qty;
        $data['id']=$product->product_id;
        $data['name']=$product->product_name;
        $data['price']=$product->product_price;
        $data['options']['image']=$product->product_image;

        Cart::add($data);
                   
        return redirect('/show_cart');
        // return view('pages.add_to_cart')->with('product',$product);
    }

    public function show_cart(){

        $categories = DB::table('tbl_category')
                        ->where('publication_status', 1)
                        ->get();

        return view('pages.add_to_cart')->with('categories',$categories);
    }
    public function delete_cart($item_id){
        Cart::remove($item_id);
        return redirect('/show_cart')->with('success' , 'Item deleted successfully');
    }

    public function destroy(){
        Cart::destroy();
        return redirect('/show_cart')->with('success' , 'Cart cleared successfully');
    }

    public function update_cart(Request $request){
        $qty = $request->qty;
        $rowId = $request->rowId;
        Cart::update($rowId, $qty);
        return redirect('/show_cart')->with('success' , 'Item updated successfully');
    }
}
