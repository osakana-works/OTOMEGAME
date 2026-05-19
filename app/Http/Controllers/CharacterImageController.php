<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CharacterImage;

class CharacterImageController extends Controller
{   
    public function create(Request $request)
    {
        // どのキャラの画像を追加するかを受け取る
        $character_id = $request->character_id;

        return view('character-images.create', compact('character_id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'character_id' => 'required|exists:characters,id',
            'pose_name' => 'nullable|string|max:255',
            'image' => 'required|image|max:2048',
        ]);

        // PNG のまま保存（変換なし）
        $path = $request->file('image')->store('character_images', 'public');

        CharacterImage::create([
            'character_id' => $request->character_id,
            'pose_name' => $request->pose_name,
            'image_path' => $path,
        ]);

        return redirect()->route('characters.edit', $request->character_id);
    }

    public function destroy(CharacterImage $image)
    {
        // 画像ファイルを削除
        if ($image->image_path && \Storage::disk('public')->exists($image->image_path)) {
            \Storage::disk('public')->delete($image->image_path);
        }

        // DB から削除
        $character_id = $image->character_id;
        $image->delete();

        // キャラ編集画面に戻る
        return redirect()->route('characters.edit', $character_id)
            ->with('success', '画像を削除しました');
    }

}