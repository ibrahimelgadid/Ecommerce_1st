<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class CheckoutController extends Controller
{
    public function login_check(){
        return view('pages.login');
    }

    public function register(Request $request){
       $data = [];

       $data['customer_name'] = $request->name;
       $data['customer_email'] = $request->email;
       $data['customer_mobile'] = $request->mobile;
       $data['customer_password'] =md5( $request->password);

       $customer_id = DB::table('tbl_customer')
                ->insertGetId($data);
        
            $request->session()->put('customer_id', $customer_id);
            $request->session()->put('customer_name', $request->name);
            return redirect('/checkout');
    }

    public function checkout(){
        return view('pages.checkout');
    }

    public function save_shipping(Request $request){
        $data = [];
 
        $data['shipping_lname'] = $request->lname;
        $data['shipping_fname'] = $request->fname;
        $data['shipping_email'] = $request->email;
        $data['shipping_mobile'] = $request->mobile;
        $data['shipping_address'] = $request->address;
        $data['shipping_city'] = $request->city;
 
        $shipping_id = DB::table('tbl_shipping')
                        ->insertGetId($data);
                        
        $request->session()->put('shipping_id', $shipping_id);
            
        return redirect('/payment');
     }

     public function login(Request $request){


        $customer_email = $request->email;
        $customer_password = md5($request->password);
 
        $customer_email1 = DB::table('tbl_customer')
                        ->where('customer_email',$customer_email)
                        ->first();
        $customer_password1 = DB::table('tbl_customer')
                        ->where('customer_password',$customer_password)
                        ->first();

        $customer_id = DB::table('tbl_customer')
                        ->where('customer_email',$customer_email)
                        ->where('customer_password',$customer_password)
                        ->first();

                        
        if(!$customer_email1){
            return back()->with('error', 'email not here');
        }elseif(!$customer_password1){
            return back()->with('error', 'password not here');
        }else{
            Session::put('customer_id', $customer_id);
            return redirect('/checkout');
        }
     }

    public function logout(){
         Session::flush();
         return redirect('/');
    }

    public function payment(){

        return view('pages.payment');
   }

   public function order_place(Request $request){
       $payment_getway= $request->payment_getway;
       echo $payment_getway;
   }

}
