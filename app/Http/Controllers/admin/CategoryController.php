<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::all();
        return view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create',['layout'=>'categories.create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreRequest $request)
    {
        if(!$request->hasFile('image')){
            echo '<script>window.alert("filed to upload the image file !!")</script>';

        }

        $imageName=time().'.'.$request->file('image')->getClientOriginalExtension();
        $imagePath=$request->file('image')->storeAs('public/categories',$imageName); //gonna be stored in the storage folder Storage/app/public/categories
        // $imagePath=$request->file('image')->move(public_path('public\categories',$imageName));
        // $imagePath=Storage::putFile('app/public/categories',$request->file('image')); //using the Storage facade to store the image in the same path we mentionned earlier

        Category::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'image'=>($imagePath),
        ]);

        return to_route('admin.categories.index')->with('success','category has been created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $imagePath=$category->image;
        if($request->hasFile('image')){
            Storage::delete($category->image);
            $imageName=time().'.'.$request->file('image')->getClientOriginalExtension();
            $imagePath=$request->file('image')->storeAs('/public/categories',$imageName);
        }
        $category->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'image'=>($imagePath),

        ]);
        return to_route('admin.categories.index')->with('success','category has been updated successfully');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        Storage::delete($category->image);
        $category->delete();
        return to_route('admin.categories.index')->with('danger','category has been deleted successfully');;

    }
}
