<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        return view('profile', compact('user'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id
        ]);
        $user = User::findOrFail($id);

        $user->Update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'skills' => $request->skills
        ]);

        return response()->json(['user' => $user]);
    }
}
