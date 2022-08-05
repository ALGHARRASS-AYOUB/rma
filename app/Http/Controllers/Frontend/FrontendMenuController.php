<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendMenuController extends Controller
{
    public function index(){
        $menus=Menu::all();
        return view('menus.index',compact('menus'));
    }
    public function show($id){
        return view('menus.show');
    }
}
