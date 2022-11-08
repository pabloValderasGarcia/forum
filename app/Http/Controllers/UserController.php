<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;

use App\Models\Post;
use App\Models\User;

use Illuminate\Http\Request;
use DB;

class UserController extends Controller
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
    public function store(UserCreateRequest $request)
    {
        try {
            $user = new User($request->all());
            $user->save();
            $this->login();
            return back()->with('works', 'User registered!');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['default' => 'Could not register user...']);
        }
    }

    public function login()
    {
        try {
            if (DB::table('user')->where('name', trim($_POST['name']))->exists()) {
                session(['name'  => $_POST['name']]);
                session(['id' => DB::table('user')->where('name', session('name'))->first()->id]);
                return redirect()->back()->with('works', 'User logged!');
            } else {
                return back()->withErrors(['userError' => "User doesn't exists..."]);
            }
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['default' => 'Could not store the post...']);
        }
    }
    
    public function logout()
    {
        session()->forget('name');
        return redirect('/')->with('works', 'User logged out!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('user.show', 
        [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, User $user)
    {
        try {
            $user->update($request->all());
            session(['name' => $user->name]);
            return redirect('user/' . $user->id)->with('works', 'User changed succesfully!');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['default' => 'Could not change user...']);
        }
    }
    
    public function picture(Request $request, User $user)
    {
        $data = $request->all();
        if ($request->hasFile('picture')) {
            $destPath = "public/assets/img/picturesProfile";
            $image = $request->file('picture');
            $imageName = $image->getClientOriginalName();
            $path = $request->file('picture')->storeAs($destPath, $imageName);
            $data['picture'] = $imageName;
            $user->update($data);
            return back()->with('works', 'User picture changed!');
        } else {
            return back()->withErrors(['default' => 'You have to choose an image...']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
