<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Models\ElectionResult;
use App\Models\PartyCandidate;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ElectionController extends Controller
{
    public function index()
    {
        $elections = Election::all();

        return view('elections.list', compact('elections'));
    }

    public function create()
    {
        return view('elections.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'type' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $data = $request->all();
        if ($request->has('is_active')) {
            if (Election::where('is_active', true)->exists()) {
                return back()->with('warning', "Can't have multiple active election at same time");
            }
            $data['is_active'] = true;
        } else {
            $data['is_active'] = false;
        }

        $election = Election::create($data);

        return redirect(route('elections.index'));
    }

    public function show(Election $election)
    {
        return view('elections.show', compact('election'));
    }

    public function edit(Election $election)
    {
        return view('elections.edit', compact('election'));
    }

    public function update(Request $request, Election $election)
    {
        $this->validate($request, [
            'title' => 'required',
            'type' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $data = $request->all();
        if ($request->has('is_active')) {
            if (Election::where('is_active', true)->where('id', '!=', $election->id)->exists()) {
                return back()->with('warning', "Can't have multiple active election at same time");
            }
            $data['is_active'] = true;
        } else {
            $data['is_active'] = false;
        }

        $election = $election->update($data);

        return redirect(route('elections.index'));
    }

    public function destroy(Election $election)
    {
        //
    }

    public function vote_now($id)
    {
        $election = Election::findOrFail($id);

        if (!$election->is_active) {
            return back()->with('warning', 'This is not a running election');
        }

        $party_candidates = PartyCandidate::all();

        return view('elections.vote-now', compact('election', 'party_candidates'));
    }

    public function vote_now_store($election_id, $candidate_id)
    {
        $election = Election::findOrFail($election_id);

        if (!$election->is_active) {
            return back()->with('warning', 'This is not a running election');
        }

        $start_date = new Carbon($election->start_date);
        $end_date = new Carbon($election->end_date);

        $dt = Carbon::now();

        if ($dt >= $start_date && $dt <= $end_date) {

            $candidate = User::findOrFail($candidate_id);

            $vote_exists = ElectionResult::where([
                'election_id' => $election->id,
                'user_id' => auth()->id(),
                'candidate_id' => $candidate->id,
            ])->exists();

            if ($vote_exists) return back()->with('warning', 'You already voted this candidate');

            $vote = ElectionResult::create([
                'election_id' => $election->id,
                'user_id' => auth()->id(),
                'candidate_id' => $candidate->id,
            ]);

            return back()->with('success', 'Your vote successfully counted');
        } else {
            return back()->with('warning', "Election isn't started yet");
        }
    }

    public function election_type($type)
    {
        $elections = Election::where('type', $type)->get();

        return view('elections.election-type', compact('elections', 'type'));
    }
}
