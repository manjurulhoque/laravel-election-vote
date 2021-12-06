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

        return redirect(route('our.manifesto'))->with('success', 'Manifesto created successfully');
    }

    public function submit_manifesto()
    {
        $manifesto = Manifesto::where('user_id', auth()->id())->first();

        if ($manifesto) {
            $manifesto->submitted = true;
            $manifesto->save();

            return back()->with('success', "Manifesto submitted successfully");
        }

        return back()->with('error', "You don't have any manifesto yet. please create one first");
    }

    public function edit()
    {
        $manifesto = Manifesto::where('user_id', auth()->id())->first();

        if ($manifesto && $manifesto->submitted) {
            return redirect(route('our.manifesto'))->with('warning', "Manifesto can not be created after submission");
        }

        if ($manifesto) {
            return view('manifestos.edit', compact('manifesto'));
        }

        return redirect(route('our.manifesto'))->with('warning', 'Please create your manifesto');
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'description' => 'required|string'
        ]);

        $manifesto = Manifesto::where('user_id', auth()->id())->first();

        if (!$manifesto) {
            return redirect(route('our.manifesto'))->with('warning', 'Please create your manifesto');
        }

        $manifesto->description = $request->get('description');
        $manifesto->save();

        return back()->with('success', "Manifesto updated successfully");
    }
}
