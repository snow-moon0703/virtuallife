<?php

namespace App\Http\Controllers;

use App;
use App\Creator;
use App\Message;
use Auth;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $check = Creator::where('id', Auth::id())->first();
        if ($check['status'] != "T") {
            return redirect()->route('error')->with('find', '創作者權限已鎖定，請洽管理員!!');
        }

        $message             = new Message;
        $message->creator_id       = Auth::id();
        $message->article_id       = $request->id;
        $message->content = $request->text;
        $message->date    = date('Y/m/d H:i:s');
        $message->save();
        return redirect()->route('article.show', $request->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = Message::find($id);
        if (Auth::id() == $message->creator_id) {
            Message::destroy($id);
        }
        //return redirect()->back();
    }
}
