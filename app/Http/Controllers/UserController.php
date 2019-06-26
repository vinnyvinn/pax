<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use PAX\Models\Permission;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('masters.users.index')
            ->with('users', User::where('id', '>', 1)->get(['id', 'name', 'email', 'created_at']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('masters.users.create')
            ->with('permissions', Permission::all(['name', 'slug']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ])->validate();

        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $data['permissions'] = json_encode(array_keys($data['permissions']));

        User::create($data);

        flash("Successfully created new user");

        return redirect()->route('user.index');
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
        $user = User::findOrFail($id);
        $user->permissions = json_decode($user->permissions);

        return view('masters.users.edit')
            ->with('user', $user)
            ->with('permissions', Permission::all(['name', 'slug']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|min:6|confirmed',
        ])->validate();

        $user = User::findOrFail($id);
        $data = $request->all();
        if (isset($data['password']) && strlen($data['password']) > 5) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
        $data['permissions'] = json_encode(array_keys($data['permissions']));

        $user->update($data);

        flash("Successfully updated user");

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();

        flash("Successfully deleted user");

        return redirect()->route('user.index');
    }

    public function changePasswordForm()
    {
        return view('auth.passwords.change');
    }

    public function changePassword(Request $request)
    {
        Validator::make($request->all(), [
            'password' => 'required|min:6|confirmed',
        ])->validate();

        if (! \Hash::check($request->get('old_password'), \Auth::user()->getAuthPassword())) {
            return redirect()->back()->withErrors([
                'old_password' => 'Invalid old password.'
            ]);
        }

        \Auth::user()->update([
            'password' => bcrypt($request->get('password'))
        ]);
        \Auth::logout();

        flash("Successfully changed password. Please log in.");

        return redirect('/');
    }
}
