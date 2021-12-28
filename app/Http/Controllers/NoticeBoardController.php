<?php

namespace App\Http\Controllers;

use App\Models\NoticeBoard;
use Illuminate\Http\Request;

class NoticeBoardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'election-commission'])->only('create', 'update', 'delete');
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
        $notice = NoticeBoard::find($id);

        return view('notices.show', compact('notice'));
    }

    public function edit(NoticeBoard $noticeBoard)
    {
        //
    }

    public function update(Request $request, NoticeBoard $noticeBoard)
    {
        //
    }

    public function destroy(NoticeBoard $noticeBoard)
    {
        //
    }
}
