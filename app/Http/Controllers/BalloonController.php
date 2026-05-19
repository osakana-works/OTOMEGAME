<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Balloon;
use App\Models\Character;

class BalloonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ログインユーザーのバルーンだけ取得
        $balloons = Balloon::where('user_id', auth()->id())->get();

        return view('balloons.index', compact('balloons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $characters = Character::where('created_by', auth()->id())->get();
        return view('balloons.create', compact('characters'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'image'        => 'required|image|max:4096',
            'character_id' => 'nullable|exists:characters,id',
        ]);

        // 画像保存
        $path = $request->file('image')->store('balloon_images', 'public');

        Balloon::create([
            'name'         => $request->name,
            'image_path'   => $path,
            'character_id' => $request->character_id, // null なら全キャラ共通
            'user_id'      => auth()->id(),
        ]);

        return redirect()->route('balloons.index')
            ->with('success', 'バルーンを追加しました！');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $balloon = Balloon::findOrFail($id);

        // 自分のデータ以外は削除できないように
        if ($balloon->user_id !== auth()->id()) {
            abort(403);
        }

        // 画像削除
        if (\Storage::disk('public')->exists($balloon->image_path)) {
            \Storage::disk('public')->delete($balloon->image_path);
        }

        // レコード削除
        $balloon->delete();

        return redirect()->route('balloons.index')
            ->with('success', 'バルーンを削除しました！');
    }

}
