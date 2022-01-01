<?php

namespace App\Http\Controllers;

use App\Models\Election;
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
}
