<?php

namespace App\Http\Controllers;

use App\Models\PartyCandidate;
use App\Models\User;
use Illuminate\Http\Request;

class PartyCandidateController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $party_candidates = $user->party_candidates;
        return view('party.selected-candidates', compact('party_candidates'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(PartyCandidate $partyCandidate)
    {
        //
    }

    public function edit(PartyCandidate $partyCandidate)
    {
        //
    }

    public function update(Request $request, PartyCandidate $partyCandidate)
    {
        //
    }

    public function all_candidates_to_select()
    {
        $party_candidate_ids = PartyCandidate::all()->pluck('candidate_id')->toArray();

        $candidates = User::where("role", "candidate")->whereNotIn('id', $party_candidate_ids)->get();

        return view('party.candidate-selection', compact('candidates'));
    }

    public function select_candidate($id)
    {
        $candidate = User::where('id', $id)->where('role', 'candidate')->first();
        if (!$candidate) {
            return back()->with('error', 'No candidate found with this id');
        }
        $exists = PartyCandidate::where('party_id', auth()->id())->where('candidate_id', $id)->first();
        if ($exists) return back()->with('warning', 'You already selected this candidate');

        $new_party_candidate = new PartyCandidate();
        $new_party_candidate->party_id = auth()->id();
        $new_party_candidate->candidate_id = $id;
        $new_party_candidate->save();

        return back()->with('success', 'Candidate successfully selected');
    }
}
