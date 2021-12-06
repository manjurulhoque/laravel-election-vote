<?php

namespace App\Http\Controllers;

use App\Models\Manifesto;
use Illuminate\Http\Request;

class ManifestoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'party']);
    }

    public function our_manifesto()
    {
        $manifesto = Manifesto::where('user_id', auth()->id())->first();

        if ($manifesto) {
            return view('manifestos.show', compact('manifesto'));
        }

        return view('manifestos.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'description' => 'required|string'
        ]);

        $new_manifesto = new Manifesto();
        $new_manifesto->description = $request->get('description');
        $new_manifesto->user_id = auth()->id();
        $new_manifesto->save();

        return redirect(route('our.manifesto'));
    }

    public function submit_manifesto()
    {
        $manifesto = Manifesto::where('user_id', auth()->id())->first();

        if($manifesto) {
            $manifesto->submitted = true;
            $manifesto->save();

            return back()->with('success', "Manifesto submitted successfully");
        }

        return back()->with('error', "You don't have any manifesto yet. please create one first");
    }
}
