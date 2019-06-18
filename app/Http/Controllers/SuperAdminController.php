<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class SuperAdminController extends Controller
{
    public function logout(Request $request){
        $request->session()->flush();
        return redirect('/admin');
    }

    public function index(Request $request){
        $this->AdminAuth();
        return view('admin.dashboard');
        
    }

    public function AdminAuth(){
        if(Session::get('admin_name')){
            return;
        }else{
            return redirect('/admin')->with('error','you not admin')->send();
        }
    }
}
