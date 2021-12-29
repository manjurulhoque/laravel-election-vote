<?php

namespace App\Http\Controllers;

use App\Models\Election;
use Illuminate\Http\Request;

class ElectionController extends Controller
{
    public function index()
    {
        //
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
    }

    public function show(Election $election)
    {
        //
    }

    public function edit(Election $election)
    {
        //
    }

    public function update(Request $request, Election $election)
    {
        //
    }

    public function destroy(Election $election)
    {
        //
    }
}
