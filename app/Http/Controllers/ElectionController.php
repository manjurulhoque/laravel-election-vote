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

            if ($election->is_published) {
                return back()->with('warning', "Election is already published");
            }
        } else {
            $data['is_active'] = false;
        }

        $election = $election->update($data);

        return redirect(route('elections.index'))->with('success', "Election is updated");
    }

    public function delete($id)
    {
        $election = Election::where('id', $id)->first();
        $election->delete();
        return back()->with('success', 'Election deleted');
    }

    public function vote_now($id)
    {
//        $cc = [211, 211, 4, 201];
//        $voters = User::where('role', 'voter')->get();
//        foreach ($cc as $c) {
//            foreach ($voters as $voter) {
////                $c = array_rand($cc, 1);
//                if (!ElectionResult::where([
//                        'election_id' => 3,
//                        'user_id' => $voter->id,
//                        'candidate_id' => $c,
//                    ])->exists() && !ElectionResult::where([
//                        'election_id' => 3,
//                        'user_id' => $voter->id,
//                    ])->exists()) {
//                    try {
//                        $vote = ElectionResult::create([
//                            'election_id' => 3,
//                            'user_id' => $voter->id,
//                            'candidate_id' => $c,
//                        ]);
//                    } catch (\Exception $exception) {
//
//                    }
//                }
//            }
//        }

        $votes = ElectionResult::where('election_id', 3)->get();

        foreach ($votes as $vote) {

            $vote->party_id = $vote->candidate->party_id;

            $vote->update();
        }

        $election = Election::findOrFail($id);

        if (!$election->is_active) {
            return back()->with('warning', 'This is not a running election');
        }

        $party_candidates = PartyCandidate::where('status', 'Accepted')->get();

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

            if (ElectionResult::where([
                'election_id' => $election->id,
                'user_id' => auth()->id(),
            ])->exists()) {
                return back()->with('warning', 'Your vote is already counted');
            }

            $vote = ElectionResult::create([
                'election_id' => $election->id,
                'user_id' => auth()->id(),
                'candidate_id' => $candidate->id,
                'party_id' => $candidate->party_id,
            ]);

            return back()->with('success', 'Your vote successfully counted');
        } else {
            return back()->with('warning', "Election isn't started yet or finished");
        }
    }

    public function election_type($type)
    {
        $elections = Election::where('type', $type)->get();

        return view('elections.election-type', compact('elections', 'type'));
    }

    public function vote_count_list($id)
    {
        $election = Election::with('vote_counts.candidate')->findOrFail($id);

        if (!$election->is_active) {
            return back()->with('warning', 'This is not a running election');
        }

        $vote_counts = $election->vote_counts;
        $winners = $election->vote_counts()->groupBy('party_id')->selectRaw('count(*) as total, party_id')->get();

//        foreach ($winners as $winner) {
//            echo $winner;
//        }

        return view('elections.votes', compact('election', 'vote_counts', 'winners'));
    }

    public function publish_result($id)
    {
        $election = Election::with('vote_counts.candidate')->findOrFail($id);

        if (!$election->is_active) {
            return back()->with('warning', 'This is not a running election');
        }

        if ($election->is_published) {
            return back()->with('warning', 'Election is already published');
        }

        $winners = $election->vote_counts()->groupBy('party_id')->selectRaw('count(*) as total, party_id')->get();

        $winners = $winners->sortBy('total');

        $winner = $winners->last();
        $election->is_active = false;
        $election->is_published = true;
        $election->winner_id = $winner->party_id;

        $election->update();

        return redirect(route('elections.index'))->with('success', 'Election is published');
    }

    public function published_elections()
    {
        $elections = Election::where('is_published', true)->get();

        return view('elections.published-elections', compact('elections'));
    }
}
