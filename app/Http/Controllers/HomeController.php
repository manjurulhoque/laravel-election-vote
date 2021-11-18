<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        return view('home');
    }

    public function register_portal()
    {
        return view('register-portal.index');
    }

    public function voter_register_portal()
    {
        return view('register-portal.voter');
    }

    public function register_submit(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'role' => ['required', 'string'],
        ]);

        var_dump($request->get('name'));

        User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'role' => $request->get('role')
        ]);

        return redirect()->route('login');
    }

    public function candidate_register_portal()
    {
        return view('register-portal.candidate');
    }

    public function party_register_portal()
    {
        return view('register-portal.party');
    }

    public function candidates()
    {
        $candidates = User::where('role', 'candidate')->with('vision')->get();
        return view("candidate.list", compact('candidates'));
    }
}
