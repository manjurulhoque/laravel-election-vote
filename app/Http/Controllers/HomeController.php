<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function __construct()
    {

    }

    public function welcome()
    {
        $election = Election::where('is_active', true)->first();
        return view('welcome', compact('election'));
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

    public function parties()
    {
        $parties = User::where('role', 'party')->get();
        return view("party.index", compact('parties'));
    }

    public function upload_profile_image()
    {
        $user = auth()->user();

        return view('edit', compact('user'));
    }

    public function save_profile_image(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = 'img/' . time() . '.' . $request->image->extension();

        $request->image->move(public_path('img'), $imageName);

        $user = auth()->user();
        $user->image = $imageName;
        $user->save();

        return back()->with('success', 'Profile updated successfully');
    }
}
