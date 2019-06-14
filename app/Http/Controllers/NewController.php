<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsPost;
use App\Http\Requests\Request;
use App\News;

class NewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::orderBy('date', 'desc')->paginate(5);
        return view('new.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('new.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsPost $request)
    {
        $new = new News;
        $this->save($new, $request);
        return redirect()->route('admin.new');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $new = News::find($id);
        if (!$new) {
            abort(404);
        }
        return view('new.show', compact('new'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $new = News::find($id);
        return view('new.create', compact('new'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsPost $request, $id)
    {
        $new = News::find($id);
        $this->save($new, $request);
        return redirect()->route('admin.new');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        News::destroy($id);
        //return redirect()->route('admin.new');
    }

    public function save($new, $request)
    {
        if ($request->hasFile('img')) {
            if ($request->file('img')->isValid()) {
                $destinationPath = base_path() . '/public/image/News/';
                $extension       = $request->file('img')->getClientOriginalExtension();
                $fileName        = date('U') . "." . $extension;
                $request->file('img')->move($destinationPath, $fileName);
                $new->image = "image/News/" . $fileName;
            }
        }
        $new->admins_id = auth('admin')->user()->id;
        $new->title     = $request->title;
        $new->content   = $request->content;
        $new->date      = date('Y/m/d H:i:s');
        $new->startdate = $request->startdate . " " . $request->starttimeh . ":" . $request->starttimem . ":00";
        $new->enddate   = $request->enddate . " " . $request->endtimeh . ":" . $request->endtimem . ":00";
        $new->save();
    }
}
