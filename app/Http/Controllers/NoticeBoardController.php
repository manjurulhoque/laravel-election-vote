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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NoticeBoard  $noticeBoard
     * @return \Illuminate\Http\Response
     */
    public function show(NoticeBoard $noticeBoard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NoticeBoard  $noticeBoard
     * @return \Illuminate\Http\Response
     */
    public function edit(NoticeBoard $noticeBoard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NoticeBoard  $noticeBoard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NoticeBoard $noticeBoard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NoticeBoard  $noticeBoard
     * @return \Illuminate\Http\Response
     */
    public function destroy(NoticeBoard $noticeBoard)
    {
        //
    }
}
