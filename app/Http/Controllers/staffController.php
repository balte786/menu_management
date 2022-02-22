<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\User;
use app\Models\staff;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Session;

class staffController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('owner')) {

            $restaurant_id = Auth::user()->restaurant_id;

            //echo $restaurant_id;
            //exit;

            $user_data = User::where('restaurant_id', $restaurant_id)->where('id', '!=', Auth::user()->id)->get();

            //print_r($user_data);
            //exit;
            return view('staff.index', ['staffData' => $user_data]);
        } else {
            return redirect()->route('dashboard')->withStatus(__('No Access'));
        }
    }

    public function create()
    {
        if (auth()->user()->hasRole('owner')) {
            $user_data['title'] = 'Create Staff';
            return view('staff.create', ['staffData' => $user_data]);
        } else {
            return redirect()->route('dashboard')->withStatus(__('No Access'));
        }
    }

    function store(Request $request)
    {

        if (auth()->user()->hasRole('owner')) {

            $request->validate([
                'name_staff' => ['required', 'string', 'unique:companies,name', 'max:255'],
                'email_staff' => ['required', 'string', 'email', 'unique:users,email,NULL,id,deleted_at,NULL', 'max:255'],
                'password_staff' => ['required', 'string', 'max:255'],

            ]);

            $staff = new User;
            $staff->name = strip_tags($request->name_staff);
            $staff->email = strip_tags($request->email_staff);
            $staff->api_token = Str::random(80);
            $staff->password = Hash::make($request->password_staff);
            $staff->restaurant_id = Auth::user()->restaurant->id;
            if ($staff->save()) {
                $staff->assignRole('staff');
            }
            return redirect('/staff')->with('status', 'You have successfully created a staff');
        } else {
            return redirect()->route('dashboard')->withStatus(__('No Access'));
        }
    }

    public function delete_staff($id)
    {

        $user_data = User::where('id', $id)->delete();
        return redirect('/staff')->with('status', 'Staff removed successfully');
    }

    public function edit_staff($id)
    {

        $user_data = DB::table('users')->where('id',$id)->first();
        return view('staff.edit', ['user_data' => $user_data]);
    }

    public function change(Request $request)
    {
        $staff = User::findOrFail($request->id);

        //print_r($staff);
        //exit;

        $staff->name = strip_tags($request->name_staff);
        //$staff->email = strip_tags($request->email_staff);
        $staff->api_token = Str::random(80);
        $staff->password = Hash::make($request->password_staff);
        $staff->restaurant_id = Auth::user()->restaurant->id;
        $staff->save();

        return redirect('/staff')->with('status', 'You have successfully updated a staff');
    }
}
