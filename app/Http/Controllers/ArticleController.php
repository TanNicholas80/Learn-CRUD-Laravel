<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index() {
        return view('article.index', [
            'articles' => Article::get()
        ]);
    }

    public function create() {
        return view('article.form');
    }

    public function store(REQUEST $request) {
        $input = $request->only(['title', 'description']);
        $create = Article::create($input);

        if($create) {
            // Make Notification With FLash
            session()->flash('notif.success', 'Article Created Sucsessfully!!');
            return redirect()->route('article.index');
        }
        
        return abort(500);
    }

    public function edit($id) {
        $article = Article::find($id);
        return view('article.form', [
            'article' => $article
        ]);
    }

    public function update(REQUEST $request, $id) {
        $input = $request->only(['title', 'description']);
        $article = Article::find($id);
        $update = $article->update($input);

        if($update) {
            // Notification Update Success
            session()->flash('notif.success', 'Article Updated Successfully!!');
            return redirect()->route('article.index');
        }
        
        return abort(500);
    }

    public function destroy($id) {
        $article = Article::find($id);
        $delete = $article->delete();

        if($delete) {
            // Notification Delete
            session()->flash('notif.success', 'Article Deleted Successfully!');
            return redirect()->route('article.index');
        }
        
        return abort(500);
    }
}
