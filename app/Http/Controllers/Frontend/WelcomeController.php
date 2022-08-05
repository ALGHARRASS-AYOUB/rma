<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class WelcomeController extends Controller
{
    public function index(){
        $specialCategory=Category::where('name','special')->first();
        return view('welcome',compact('specialCategory'));
    }
}
