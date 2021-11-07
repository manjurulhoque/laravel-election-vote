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
        //
    }

    public function show(Vision $vision)
    {
        //
    }

    public function edit(Vision $vision)
    {
        //
    }

    public function update(Request $request, Vision $vision)
    {
        //
    }
}
