<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $data['data'] = User::latest()->get();
        return view('user.index', $data);
    }
    
    public function store(Request $request) {
        $datas = $request->all();
        $datas['password'] = bcrypt($request->password);
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
            $path = $file->move('public/file_upload', $imageName, 'public');
            $datas['foto'] = 'public/file_upload/'.$imageName;
        }
        $save = User::create($datas);
        return redirect()->back()->with('success', 'Your data has been saved successfully!');
    }

    
    public function update(Request $request, $id) {
        $save = User::find($id);
        $datas = $request->all();
        if ($request->password) {
            $datas['password'] = bcrypt($request->password);
        }else{
            unset($datas['password']);
        }
        
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
            $path = $file->move('public/file_upload', $imageName, 'public');
            $datas['foto'] = 'public/file_upload/'.$imageName;
        }
        $save->update($datas);
        return redirect()->back()->with('success', 'Your data has been updated successfully!');
    }
    
    public function destroy( $id) {
        $save = User::find($id)->delete();

        return redirect()->back()->with('success', 'Your data has been delete successfully!');
    }
    public function logins()  {
        return view('welcome');
    }
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
    
        $credentials = $request->only('username', 'password');
    
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->route('dashboard')->with('success', 'Welcome back!');
        }
    
        return Redirect::back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate the user's session and regenerate the CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('success', 'You have been logged out successfully!');
    }

    public function gantipassword() {
        return view('gantipassword');
    }

    public function gantipassword_act(Request $request) {
        $user = User::find(auth()->user()->id);
        $user->update(['password' => $request->password]);
        return redirect()->back()->with('success', 'Success Change Password!');
    }
}
