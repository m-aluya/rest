<?php

namespace App\Http\Controllers\AdminUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AdminController extends Controller
{
    public function admin()
    {
        $access = collect(DB::table('menu')->get());
        return view('admin.index', compact('access'));
    }

    public function saveAdmin(Request $request)
    {

        //  dd($request->only('accountType'));
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:admin',
            'password' => 'required|min:4'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'organization_id' => $request->org_id,
            'accounttype' => $request->accountType,
            'role' => json_encode($request->access),
            'password' => bcrypt($request->password),
        ]);
        if ($user) {
            return redirect()->back()->with('success', 'User Created Successfully. Inform the user to change the password after login.');
        } else {
            return redirect()->back()->with('error', 'User Creation Failed. Please try again.');
        }
    }

    public function getAdmins()
    {
        $admins = User::all();
        return view('admin.admins', compact('admins'));
    }

    public function password()
    {
        return view('admin.password');
    }
}
