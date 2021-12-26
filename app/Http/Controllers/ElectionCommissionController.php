<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ElectionCommissionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'election-commission']);
    }

    public function voter_list()
    {
        $voters = User::where('role', 'voter')->paginate(9);
        return view('election-commission.voter-list', compact('voters'));
    }
}
