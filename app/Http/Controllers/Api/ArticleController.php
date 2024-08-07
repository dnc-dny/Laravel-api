<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // READ 全取得
        $articles = Article::all();
        return response($articles, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // UPDATE
        $article = new Article;

        $article->title = $request->input('title');
        $article->body = $request->input('body');

        $article->save();
        return response($article, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // READ 単一取得
        $article = Article::find($id);
        return response($article, 200);
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
        // UPDATE
        $article = Article::find($id);

        $article->title = $request->input('title');
        $article->body = $request->input('body');

        $article->save();
        return response($article, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // DELETE
        Article::destroy($id);
        return response('ok', 200);
    }
}
