<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use validator;

class templateController extends Controller
{
    public function index()
    {
        //echo 'here';
        //exit;
        if (auth()->user()->hasRole('admin')) {

            $user_data = Template::get()->all();

            return view('templates.index', ['tempData' => $user_data]);
        } else {
            return redirect()->route('dashboard')->withStatus(__('No Access'));
        }
    }


    public function create()
    {

        $user_data['title'] = 'Create Template';
        return view('templates.create', ['tempData' => $user_data]);
    }

    function store(Request $request)
    {

        $this->validate($request, [
            'name_template' => ['required', 'string', 'unique:companies,name', 'max:255'],
            'image_template' => 'required|image|mimes:jpeg,jpg,png|max:3048',
        ]);

        $temp = new Template;
        $temp->name = strip_tags($request->name_template);
        if ($request->hasFile('image_template')) {
            $file = $request->file('image_template');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/template/', $filename);
            $temp->picture = $filename;
        }
        $temp->save();

        return redirect('/template')->with('status', 'You have successfully created a template');
    }

    public function delete_template($id)
    {

        $temp = Template::findorfail($id);
        $destination = public_path("uploads/template/" . $temp->picture);
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $temp->delete();
        return redirect('/template')->with('status', 'Template removed Successfully');
    }

    public function edit_template($id)
    {

        $user_data = Template::find($id);
        return view('templates.edit', ['user_data' => $user_data]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name_template' => ['string', 'unique:companies,name', 'max:255'],
            'image_template' => ['mimes:jpeg,jpg,png', 'max:3048'],
        ]);

        $temp = Template::find($id);
        $temp->name = $request->input('name_template');
        if ($request->hasFile('image_template')) {

            $destination = public_path("uploads/template/" . $temp->picture);
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('image_template');
            $extension = $file->getClientOriginalName();
            $filename = time() . '.' . $extension;
            $file->move('uploads/template/', $filename);
            $temp->picture = $filename;
        }
        $temp->save();

        return redirect('/template')->with('status', 'You have successfully updated a Template');
    }
}
