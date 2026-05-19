<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Background;
use Illuminate\Support\Facades\Storage;

class BackgroundController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ログインユーザーの背景だけ取得
        $backgrounds = Background::where('user_id', auth()->id())->get();

        return view('backgrounds.index', compact('backgrounds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backgrounds.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|max:4096',
        ]);

        // 画像保存
        $path = $request->file('image')->store('background_images', 'public');

        Background::create([
            'name' => $request->name,
            'image_path' => $path,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('backgrounds.index')
            ->with('success', '背景を追加しました！');
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
    public function destroy(Background $background)
    {
        // 画像ファイル削除
        if ($background->image_path && Storage::disk('public')->exists($background->image_path)) {
            Storage::disk('public')->delete($background->image_path);
        }

        // DB削除
        $background->delete();

        return redirect()->route('backgrounds.index')
            ->with('success', '背景を削除しました！');
    }
}
