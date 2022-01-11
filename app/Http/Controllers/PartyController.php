<?php

namespace App\Http\Controllers;

use App\Models\Manifesto;
use App\Models\User;
use Illuminate\Http\Request;

class PartyController extends Controller
{
    public function __construct()
    {
        $this->middleware('party')->except('party_profile');
    }

    public function party_profile($id)
    {
        $party = User::where('role', 'party')->where('id', $id)->first();

        if (!$party) return abort(401, "Unauthorized");

//        $party->load('party_candidates');
        $manifesto = Manifesto::where('user_id', $id)->first();

        return view('party.profile', compact('party', 'manifesto'));
    }
}
