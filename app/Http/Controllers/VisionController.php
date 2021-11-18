<?php

namespace App\Http\Controllers;

use App\Models\Vision;
use Illuminate\Http\Request;

class VisionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['candidate']);
    }

    public function index()
    {
        //
    }

    public function create()
    {
        $vision = auth()->user()->vision;
        if ($vision) {
            return redirect(route('visions.edit', $vision->id));
        }
        return view('candidate.visions.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'description' => ['required']
        ]);

        $vision = Vision::create([
            'user_id' => auth()->id(),
            'description' => $request->get('description')
        ]);

        return redirect(route('visions.edit', $vision->id));
    }

    public function show(Vision $vision)
    {
        //
    }

    public function edit(Vision $vision)
    {
        if ($vision->user_id != auth()->id()) {
            return abort(403, "You are not authorized to view this resource");
        }
        return view('candidate.visions.edit', compact('vision'));
    }

    public function update(Request $request, Vision $vision)
    {
        if ($vision->user_id != auth()->id()) {
            return abort(403, "You are not authorized to view this resource");
        }

        $vision->description = $request->get('description');
        $vision->save();
        return redirect(route('visions.edit', $vision->id));
    }
}
