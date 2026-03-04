<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use App\Models\Category;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $todos = Todo::all();
        return view('index', compact('todos', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate(
            ['category_id' => 'required', 'content' => 'required',],
            ['category_id.required' => 'カテゴリを選択してください',
            'content.required'     => 'Todoの内容を入力してください',]
        );

        Todo::create($request->all());

        return redirect('/')->with('message', 'Todoを作成しました');
    }

    public function update(TodoRequest $request)
    {
        $todo = $request->all();
        Todo::find($request->id)->update($todo);

        return redirect('/')->with('message', 'Todoを更新しました');
    }

    public function destroy(Request $request)
    {
        Todo::findOrFail($request->id)->delete();

        return redirect('/')->with('message', 'Todoを削除しました');
    }
}
