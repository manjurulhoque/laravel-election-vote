<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VoterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'voter']);
    }

    public function profile()
    {
        $voter = auth()->user();

        return view('voter.profile', compact('voter'));
    }
}
