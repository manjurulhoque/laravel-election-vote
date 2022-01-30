<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Models\NoticeBoard;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function __construct()
    {

    }

    public function welcome()
    {
        $commission = User::where('role', 'election')->firstOrFail();
        $election = Election::where('is_active', true)->where('is_published', false)->first();
        $notices = NoticeBoard::all();
        return view('welcome', compact('election', 'commission', 'notices'));
    }

    public function index()
    {
        return redirect(route('welcome'));
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
            'city' => ['required', 'string'],
            'nid' => ['required', 'string'],
            'mobile' => ['required'],
            'age' => ['required'],
            'dob' => ['required', 'date','before:18 years ago'],
            'gender' => ['required', 'in:male,female'],
        ], [
            'dob.before' => 'User must be 18 years old'
        ]);

        // age validation
//        $age = Carbon::parse($request->get('dob'))->age;
//        if ($age < 18) {
//            return
//        }

        User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'role' => $request->get('role'),
            'city' => $request->get('city'),
            'nid' => $request->get('nid'),
            'mobile' => $request->get('mobile'),
            'age' => $request->get('age'),
            'dob' => $request->get('dob'),
            'gender' => $request->get('gender'),
        ]);

        return redirect()->route('login')->with('success', 'Successfully registered as voter');
    }

    public function candidate_register_portal()
    {
        $parties = User::where('role', 'party')->get();
        return view('register-portal.candidate', compact('parties'));
    }

    public function candidate_register_submit(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'role' => ['required', 'string'],
            'city' => ['required', 'string'],
            'nid' => ['required', 'string'],
            'mobile' => ['required'],
            'age' => ['required'],
            'is_married' => ['required'],
            'dob' => ['required', 'date'],
            'religion' => ['required'],
            'party_id' => ['required'],
            'gender' => ['required', 'in:male,female'],
        ]);

        User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'role' => $request->get('role'),
            'city' => $request->get('city'),
            'nid' => $request->get('nid'),
            'mobile' => $request->get('mobile'),
            'age' => $request->get('age'),
            'dob' => $request->get('dob'),
            'gender' => $request->get('gender'),
            'religion' => $request->get('religion'),
            'party_id' => $request->get('party_id'),
            'is_married' => $request->get('is_married') == 'married',
        ]);

        return redirect()->route('login')->with('success', 'Successfully registered as candidate');
    }

    public function party_register_portal()
    {
        return view('register-portal.party');
    }

    public function party_register_submit(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'role' => ['required', 'string'],
        ]);

        User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'role' => $request->get('role'),
        ]);

        return redirect()->route('login')->with('success', 'Successfully registered as party');
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
