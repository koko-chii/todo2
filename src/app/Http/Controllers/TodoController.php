<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use App\Models\Category;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $query = Todo::with('category');

        if ($request->category_id) {
        $query->where('category_id', $request->category_id);
        }

        if ($request->keyword) {
        $query->where('content', 'LIKE', "%{$request->keyword}%");
        }

        $todos = $query->get();

        return view('index', compact('todos', 'categories'));
    }

    public function store(TodoRequest $request)
    {

        $todo = $request->only(['category_id', 'content']);
        Todo::create($todo);

        return redirect('/')->with('message', 'Todoを作成しました');
    }

    public function update(TodoRequest $request)
    {
        $todo = $request->only(['content']);
        Todo::find($request->id)->update($todo);

        return redirect('/')->with('message', 'Todoを更新しました');
    }

    public function destroy(Request $request)
    {
        Todo::findOrFail($request->id)->delete();

        return redirect('/')->with('message', 'Todoを削除しました');
    }

    public function search(Request $request)
    {
        $todos = Todo::with('category')->categorySearch($request->category_id)->keywordSearch($request->keyword)->get();
        $categories = Category::all();

        return view('index', compact('todos', 'categories'));
    }
}
