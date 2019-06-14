<?php

namespace App\Http\Controllers;

use App\Article;
use App\Creator;
use App\Http\Requests\ArticlePost;
use App\Message;
use Auth;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $per    = 10;
        $search = request('search');
        if ($search) {
            $articles   = Article::where('title', 'like', '%' . $search . '%')->orwhere('content', 'like', '%' . $search . '%')->orderBy('date', 'desc')->paginate($per);
            $appendData = $articles->appends(array(
                'search' => $search,
            ));
        } else {
            $articles = Article::orderBy('date', 'desc')->paginate($per);
        }
        return view('article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticlePost $request)
    {
        $check = Creator::where('id', Auth::id())->first();
        if ($check['status'] != "T") {
            return redirect()->route('error')->with('find', '創作者權限已鎖定，請洽管理員!!');
        }

        $article            = new Article;
        $article->creator_id      = Auth::id();
        $article->title   = $request->title;
        $article->content = $request->text;
        $article->date    = date('Y/m/d H:i:s');
        $article->save();
        $id = $article->id;
        return redirect()->route('article.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        if (!$article) {
            abort(404);
        }
        $messages = Message::where('article_id', $id)->paginate(5);
        return view('article.show', compact('article', 'messages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        return view('article.create', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticlePost $request, $id)
    {
        $check = Creator::where('id', Auth::id())->first();
        if ($check['status'] != "T") {
            return redirect()->route('error')->with('find', '創作者權限已鎖定，請洽管理員!!');

        }
        $article            = Article::find($id);
        $article->title   = $request->title;
        $article->content = $request->text;
        $article->save();
        return redirect()->route('article.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        if (Auth::id() == $article->creator_id) {
            $de = Message::where('article_id', $id)->delete();
            Article::destroy($id);
        }
        // return redirect('/article');
    }
}
