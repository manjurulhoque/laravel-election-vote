<?php

namespace App\Http\Controllers;

use App\Models\NoticeBoard;
use Illuminate\Http\Request;

class NoticeBoardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'election-commission'])->except('index', 'show');
    }

    public function index()
    {
        $notices = NoticeBoard::all();
        return view('notices.index', compact('notices'));
    }

    public function create()
    {
        return view('notices.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);

        $new_notice = NoticeBoard::create($request->all());

        return redirect(route('notices.show', $new_notice->id))->with('success', 'Notice created successfully');
    }

    public function show($id)
    {
        $notice = NoticeBoard::findOrFail($id);

        return view('notices.show', compact('notice'));
    }

    public function edit($id)
    {
        $notice = NoticeBoard::findOrFail($id);

        return view('notices.edit', compact('notice'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);

        $notice = NoticeBoard::findOrFail($id);
        $notice->fill($request->all())->save();

        return redirect(route('notices.show', $notice->id))->with('success', 'Notice updated successfully');
    }

    public function destroy($id)
    {
        $notice = NoticeBoard::findOrFail($id);

        $notice->delete();

        return back()->with('success', 'Notice deleted successfully');
    }
}
