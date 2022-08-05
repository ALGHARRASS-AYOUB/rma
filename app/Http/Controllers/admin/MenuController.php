<?php

namespace App\Http\Controllers\admin;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\MenuStoreRequest;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus=Menu::all();
        return view('admin.menus.index',compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        return view('admin.menus.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuStoreRequest $request)
    {
        if(!$request->validated())
            echo '<script>window.alert("filed to send request !!")</script>';

            if(!$request->hasFile('image')){
                echo '<script>window.alert("filed to upload the image file !!")</script>';
            }
            $imageName=time().'.'.$request->file('image')->getClientOriginalExtension();
            $imagePath=$request->file('image')->storeAs('public/menus',$imageName);
            // dd($_POST);
            $menu= Menu::create([
                'name'=>$request->name,
                'price'=>$request->price,
                'description'=>$request->description,
                'image'=>$imagePath,
            ]);
            if($request->has('categories'))
                $menu->categories()->attach($request->categories);
           return to_route('admin.menus.index')->with('success','menu has been created successfully');

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
    public function edit(Menu $menu)
    {

        $categories=Category::all();
        $categoryOfThisMenu=$menu->categories;
        return view('admin.menus.edit',compact('menu','categories','categoryOfThisMenu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Menu $menu)
    {
        $imagePath=$menu->image;
        if($request->hasFile('image')){
            $imageName=time().'.'.$request->file('image')->getClientOriginalExtension();
            Storage::delete($menu->image);
            $imagePath=$request->file('image')->storeAs('public/menus',$imageName);
        }
        $menu->update([
            'name'=>$request->name,
            'price'=>$request->price,
            'description'=>$request->description,
            'image'=>$imagePath,
        ]);
        // dd($_POST);
        $menu->categories()->sync($request->categories);

        return to_route('admin.menus.index')->with('success','menu has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        Storage::delete($menu->image);
        $menu->delete();
        DB::delete('delete from category_menu where menu_id='.$menu->id.';');

        return to_route('admin.menus.index')->with('danger','category has been deleted successfully');

    }
}
