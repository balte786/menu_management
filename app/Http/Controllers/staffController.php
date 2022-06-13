<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\User;
use app\Models\staff;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Restorant;
use Session;


class staffController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('owner')) {

            $user_data = User::where('owner_id', Auth::user()->id)->get();
            return view('staff.index', ['staffData' => $user_data]);
        } elseif (auth()->user()->hasRole('staff')) {
            return redirect('/categories');
        } else {
            return redirect()->route('dashboard')->withStatus(__('No Access'));
        }
    }
    public function login_as_branch($id)
    {
        Auth::loginUsingId($id);
        return redirect('/categories');
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
                'name' => ['required', 'string', 'unique:companies,name', 'max:255'],
                'name_staff' => ['required', 'string', 'unique:companies,name', 'max:255'],
                'email_staff' => ['required', 'string', 'email', 'unique:users,email,NULL,id,deleted_at,NULL', 'max:255'],
                'password_staff' => ['required', 'string', 'max:255', 'min:8'],

            ]);

            $staff = new User;
            $staff->name = strip_tags($request->name_staff);
            $staff->email = strip_tags($request->email_staff);
            $staff->owner_id = Auth::user()->id;
            $staff->api_token = Str::random(80);
            $staff->password = Hash::make($request->password_staff);
            if ($staff->save()) {
                $staff->assignRole('staff');
            }


            $restaurant = new Restorant;
            $restaurant->name = strip_tags($request->name);
            $restaurant->user_id = $staff->id;
            $restaurant->description = strip_tags($request->description . '');
            $restaurant->minimum = $request->minimum | 0;
            $restaurant->lat = 0;
            $restaurant->lng = 0;
            $restaurant->address = '';
            $restaurant->subdomain = $this->makeAlias(strip_tags($request->name));
            $restaurant->save();

            User::where('id', $staff->id)
                ->update([
                    'restaurant_id' => $restaurant->id
                ]);


            return redirect('/staff')->with('status', 'You have successfully created a staff');
        } else {
            return redirect()->route('dashboard')->withStatus(__('No Access'));
        }
    }

    public function delete_staff($id)
    {
        DB::table('users')
            ->where('id', $id)  // find your user by their email
            ->limit(1)  // optional - to ensure only one record is updated.
            ->update(array('deleted_at' => date('Y-m-d H:i:s')));

        return redirect('/staff')->with('status', 'Staff removed successfully');
    }

    public function edit_staff($id)
    {
        if (auth()->user()->hasRole('owner')) {
            $user_data = User::find($id);
            $restorant = Restorant::select('name')->where('user_id', $id)->first();;
            // dd($restorant);
            return view('staff.edit', ['user_data' => $user_data, 'restorant' => $restorant]);
        }
    }

    public function change(Request $request)
    {

        $request->validate([
            'name_staff' => ['required', 'string', 'unique:companies,name', 'max:255'],
            'password_staff' => ['required', 'string', 'max:255', 'min:8'],

        ]);

        if (auth()->user()->hasRole('owner')) {
            $staff = User::find($request->id);
            $staff->name = strip_tags($request->name_staff);
            $staff->api_token = Str::random(80);
            $staff->password = Hash::make($request->password_staff);
            $staff->save();

            $restaurant = Restorant::where('user_id', $request->id)->limit(1)->update(array('name' => $request->branch_name));

            return redirect('/staff')->with('status', 'You have successfully updated a staff');
        }
    }
}
