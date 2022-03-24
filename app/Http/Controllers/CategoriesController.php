<?php

namespace App\Http\Controllers;

use App\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use validator;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categories::with('children')->where('parent_id',0)->where('restorant_id',auth()->user()->restorant->id)->get();

        return view('categories.index')->with([
            'categories'  => $categories
        ]);
    }

    public function store_category(Request $request){

        $validatedData = $this->validate($request, [
            'name'      => 'required|min:3|max:255|string',
            'parent_id' => 'sometimes|nullable|numeric',
            'restorant_id'=>'required'
        ]);
        $category = new Categories;
        $category->name = strip_tags($request->name);
        $category->restorant_id = $request->restorant_id;
        $category->parent_id = $request->parent_id;
        if ($request->hasFile('cat_img')) {
            $file = $request->file('cat_img');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/categories/', $filename);
            $category->category_img = $filename;
        }
        $category->save();
        return redirect()->route('categories.index')->withSuccess('You have successfully created a Category!');
    }

    public function update_category(Request $request, $id)
    {
        $category   =   Categories::find($id);
        $category->name = $request->name;
        if ($request->hasFile('cat_img')) {

            $destination = public_path("uploads/categories/" . $category->category_img);
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('cat_img');
            $extension = $file->getClientOriginalName();
            $filename = time() . '.' . $extension;
            $file->move('uploads/categories/', $filename);
            $category->category_img = $filename;
        }
        $category->update();

        return redirect()->route('categories.index')->withSuccess('You have successfully updated a Category!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Categories;
        $category->name = strip_tags($request->category_name);
        $category->restorant_id = $request->restaurant_id;
        if ($request->hasFile('cat_img')) {
            $file = $request->file('cat_img');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/categories/', $filename);
            $category->category_img = $filename;
        }
        $category->save();

        if (auth()->user()->hasRole('admin')) {
            //Direct to that page directly
            return redirect()->route('items.admin', ['restorant' => $request->restaurant_id])->withStatus(__('Category successfully created.'));
        }

        return redirect()->route('items.index')->withStatus(__('Category successfully created.'));
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categories $category)
    {
        $category->name = $request->category_name;
        if ($request->hasFile('cat_img')) {

            $destination = public_path("uploads/categories/" . $category->category_img);
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('cat_img');
            $extension = $file->getClientOriginalName();
            $filename = time() . '.' . $extension;
            $file->move('uploads/categories/', $filename);
            $category->category_img = $filename;
        }
        $category->active = $request->cat_status;
        $category->update();

        return redirect()->back()->withStatus(__('Category successfully updated.'));
    }

    // public function change(Categories $category, Request $request)
    // {
    //     $item->available = $request->value;
    //     $item->update();

    //     return response()->json([
    //         'data' => [
    //             'itemAvailable' => $item->available,
    //         ],
    //         'status' => true,
    //         'errMsg' => '',
    //     ]);
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categories $category)
    {
        $category->delete();
        return redirect()->route('items.index')->withStatus(__('Category successfully deleted.'));
    }

    public function destroy_category($id){

        $category   =   Categories::find($id);

        if ($category->children) {
            foreach ($category->children()->with('items')->get() as $child) {
                foreach ($child->items as $item) {
                    $item->update(['category_id' => NULL]);
                }
            }

            $category->children()->forceDelete();
        }

        foreach ($category->items as $item) {
            $item->update(['category_id' => NULL]);
        }

        $category->forceDelete();

        return redirect()->route('categories.index')->withSuccess('You have successfully deleted a Category!');
    }

    public function active_category($id,$active){

        if($active==1){
            $set_active = 0;
        }else{
            $set_active = 1;
        }
        $category   =   Categories::find($id);
        $category->active = $set_active;
        $category->update();
        return redirect()->route('categories.index')->withSuccess('You have successfully updated status of a Category!');

    }
}
