<?php

namespace App\Http\Controllers;

use App\Models\PartyCandidate;
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

        $party = PartyCandidate::where('candidate_id', $candidate->id)->first();

        return view('candidate.show', compact('candidate', 'party'));
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

    public function request_to_party()
    {
        $party_candidate = PartyCandidate::where('candidate_id', auth()->id())->first();
        if ($party_candidate) {
            if ($party_candidate->status == 'Requested') {
                return redirect(route('welcome'))->with('warning', 'You already requested to a party');
            }
            if ($party_candidate->status == 'Accepted') {
                return redirect(route('welcome'))->with('warning', 'You request is already accepted by a party');
            }
        }

        $parties = User::where('role', 'party')->get();

        return view('party.request-to-party', compact('parties'));
    }

    public function request_to_party_submit(Request $request)
    {
        $this->validate($request, [
            'party_id' => 'required'
        ]);

        $party_id = $request->get('party_id');

        $party_candidate = PartyCandidate::where('candidate_id', auth()->id())->first();
        if ($party_candidate) {
            if ($party_candidate->status == 'Requested') {
                return back()->with('warning', 'You already requested to a party');
            }
            if ($party_candidate->status == 'Accepted') {
                return back()->with('warning', 'You request is already accepted by a party');
            }
        }

        $party = User::where('role', 'party')->where('id', $party_id)->firstOrFail();
        $candidate = auth()->user();

        $new_request = PartyCandidate::create([
            'party_id' => $party_id,
            'candidate_id' => auth()->id(),
            'status' => 'Requested',
        ]);

        return back()->with('success', 'Your request is successfully submitted');
    }
}
