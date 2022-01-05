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

    public function request_status()
    {
        $party_candidates = PartyCandidate::where('candidate_id', auth()->id())->get();

        return view('party.check-status', compact('party_candidates'));
    }

    public function request_to_party()
    {
        $party_candidate = PartyCandidate::where('candidate_id', auth()->id())->first();
        if ($party_candidate) {
            if ($party_candidate->status == 'Requested') {
                return redirect(route('welcome'))->with('warning', 'You already submitted your nominee to a party');
            }
            if ($party_candidate->status == 'Accepted') {
                return redirect(route('welcome'))->with('warning', 'You nominee is already accepted by a party');
            }
        }

        $parties = User::where('role', 'party')->get();

        return view('party.request-to-party', compact('parties'));
    }

    public function request_to_party_submit(Request $request)
    {
        $this->validate($request, [
            'candidate_name' => 'required',
            'mother_name' => 'required',
            'father_name' => 'required',
            'mobile' => 'required',
            'description' => 'required',
            'village' => 'required',
            'post_office' => 'required',
            'upazilla' => 'required',
            'district' => 'required',
        ]);

        $party_id = auth()->user()->party_id;

        $party_candidate = PartyCandidate::where('candidate_id', auth()->id())->first();
        if ($party_candidate) {
            if ($party_candidate->status == 'Requested') {
                return back()->with('warning', 'You already requested to a party');
            }
            if ($party_candidate->status == 'Accepted') {
                return back()->with('warning', 'You request is already accepted by a party');
            }
        }

        $data = $request->all();
        $data['party_id'] = $party_id;
        $data['candidate_id'] = auth()->id();
        $data['status'] = 'Requested';

        $party = User::where('role', 'party')->where('id', $party_id)->firstOrFail();

        $new_request = PartyCandidate::create($data);

        return redirect(route('welcome'))->with('success', 'Your nominee is successfully submitted');
    }
}
