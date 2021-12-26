<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// メモモデルを呼び出し
use App\Models\Memo;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //ここでメモを取得(上で呼び出したメモモデルを使う)
        $memos = Memo::select('memos.*')
            ->where('user_id', '=', \Auth::id())
            ->whereNull('deleted_at')
            ->orderBy('updated_at', 'DESC')// ASC＝小さい順、DESC=大きい順
            ->get();

        //createviewにconpactという関数を使いDBから取得したメモ一覧を渡す
        return view('create', compact('memos'));
    }

    public function store(Request $request)
    {
        $posts = $request->all();

        //ここでフォームから入力したメモをDBに保存(上で呼び出したメモモデルを使う)
        Memo::insert(['content' => $posts['content'], 'user_id' => \Auth::id()]);

        return redirect( route('home'));
    }

    public function edit($id)
    {
        //ここでメモを取得(上で呼び出したメモモデルを使う)
        $memos = Memo::select('memos.*')
            ->where('user_id', '=', \Auth::id())
            ->whereNull('deleted_at')
            ->orderBy('updated_at', 'DESC')// ASC＝小さい順、DESC=大きい順
            ->get();

            //findを使うと主キーを元に1行分データが取れる
            $edit_memo = Memo::find($id);

        //createviewにconpactという関数を使いDBから取得したメモ一覧を渡す
        return view('edit', compact('memos', 'edit_memo'));
    }

    public function update(Request $request)
    {
        $posts = $request->all();
        //updateを使う際は必ずwhereを使う
        Memo::where('id', $posts['memo_id'])->update(['content' => $posts['content']]);

        return redirect( route('home'));
    }

    public function destory(Request $request)
    {
        $posts = $request->all();
        //delete系を使う際は必ずwhereを使う
        // Memo::where('id', $posts['memo_id'])->delete(); ⇦NG。物理削除になる
        Memo::where('id', $posts['memo_id'])->update(['deleted_at' => date("Y-m-d H:i:s", time())]);

        return redirect( route('home'));
    }
}
