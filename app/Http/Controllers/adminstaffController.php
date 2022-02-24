<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\User;
use app\Models\staff;
use Doctrine\DBAL\Types\IntegerType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Ramsey\Uuid\Type\Integer;
use Session;

class adminstaffController extends Controller
{
    public function index($id)
    {
        if (auth()->user()->hasRole('admin')) {


            $user_data = User::where('restaurant_id', $id)->where('id', '!=', Auth::user()->id)->get();

            return view('admin-staff.index', ['staffData' => $user_data]);
        } else {
            return redirect()->route('dashboard')->withStatus(__('No Access'));
        }
    }

    public function create($id)
    {
        if (auth()->user()->hasRole('admin')) {
            $user_data['title'] = 'Create Staff';

            return view('admin-staff.create', ['staffData' => $user_data,'res_id'=>$id]);
        } else {
            return redirect()->route('dashboard')->withStatus(__('No Access'));
        }
    }

    public function storeStaff(Request $request, $id)
    {

        if (auth()->user()->hasRole('admin')) {

            $request->validate([
                'name_staff' => ['required', 'string', 'unique:companies,name', 'max:255'],
                'email_staff' => ['required', 'string', 'email', 'unique:users,email,NULL,id,deleted_at,NULL', 'max:255'],
                'password_staff' => ['required', 'string', 'max:255'],

            ]);
            $staff = new User;
            $staff->restaurant_id = $id;
            $staff->name = strip_tags($request->name_staff);
            $staff->email = strip_tags($request->email_staff);
            $staff->api_token = Str::random(80);
            $staff->password = Hash::make($request->password_staff);
            if ($staff->save()) {
                $staff->assignRole('staff');
            }
            return redirect('admin-staff/' . $id)->with('status', 'Staff added successfully');
        } else {
            return redirect()->route('dashboard')->withStatus(__('No Access'));
        }
    }

    public function delete_staff($id, $res_id)
    {
        if (auth()->user()->hasRole('admin')) {
            $user_data = User::where('id', $id)->delete();
            return redirect('admin-staff/' . $res_id)->with('status', 'Staff removed successfully');
        } else {
            return redirect()->route('dashboard')->withStatus(__('No Access'));
        }
    }

    public function edit_adm_staff($id)
    {
        if (auth()->user()->hasRole('admin')) {
            $user_data = User::find($id);
            return view('admin-staff.edit', ['user_data' => $user_data]);
        }
    }

    public function change_admin(Request $request, $id)
    {
        if (auth()->user()->hasRole('admin')) {
            $staff = User::find($request->id);
            $staff->name = strip_tags($request->name_staff);
            $staff->email = strip_tags($request->email_staff);
            $staff->api_token = Str::random(80);
            $staff->password = Hash::make($request->password_staff);
            $staff->save();

            return redirect('admin-staff/' . $staff->restaurant_id)->with('status', 'You have successfully updated a staff');
        }
    }
}
