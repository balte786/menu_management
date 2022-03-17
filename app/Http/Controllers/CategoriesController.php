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
        //
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
}
