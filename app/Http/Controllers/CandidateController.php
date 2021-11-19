<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'candidate'])->except(['show']);
    }

    public function profile()
    {
        $candidate = auth()->user();

        return view('candidate.profile', compact('candidate'));
    }

    public function show($id)
    {
        $candidate = User::find($id);
        if (!$candidate) return abort(404);

        return view('candidate.show', compact('candidate'));
    }

    public function edit()
    {
        $candidate = auth()->user();

        return view('candidate.edit', compact('candidate'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = 'img/' . time() . '.' . $request->image->extension();

        $request->image->move(public_path('img'), $imageName);

        $candidate = auth()->user();
        $candidate->image = $imageName;
        $candidate->save();

        return redirect(route('candidate.profile'));
    }
}
