<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Scene;
use App\Models\Character;
use App\Models\Balloon;
use App\Models\Background;
use App\Models\CharacterImage;

class SceneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $story_id = $request->story_id;

        $query = Scene::whereHas('story', function ($q) {
            $q->where('created_by', auth()->id());
        });

        if ($story_id) {
            $query->where('story_id', $story_id);
        }

        $scenes = $query->get();

        return view('scenes.index', compact('scenes', 'story_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $story_id = $request->story_id;

        // 次の order を自動計算
        $nextOrder = Scene::where('story_id', $story_id)->count() + 1;

        // 追加：ユーザーのデータを取得
        $characters = Character::where('created_by', auth()->id())->get();
        $backgrounds = Background::where('user_id', auth()->id())->get();
        $balloons = Balloon::where('user_id', auth()->id())->get();
        $characterImages = CharacterImage::with('character')
            ->whereHas('character', function ($q) {
                $q->where('created_by', auth()->id());
            })
            ->get();



        return view('scenes.create', compact(
            'story_id',
            'nextOrder',
            'backgrounds',
            'balloons',
            'characterImages'
        ));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $request->validate([
            'story_id' => 'required|exists:stories,id',
            'order'    => 'required|integer',
            'text'     => 'nullable|string',

            // 追加：背景画像（null OK、選んだら backgrounds に存在する必要あり）
            'background_id1' => 'nullable|exists:backgrounds,id',
            'background_id2' => 'nullable|exists:backgrounds,id',

            // 追加：キャラ画像（null OK、選んだら character_images に存在する必要あり）
            'character_image1_id' => 'nullable|exists:character_images,id',
            'character_image2_id' => 'nullable|exists:character_images,id',
            'character_image3_id' => 'nullable|exists:character_images,id',

            // 追加：バルーン（null OK、選んだら balloons に存在する必要あり）
            'balloon_id' => 'nullable|exists:balloons,id',
        ]);

        Scene::create([
            'story_id' => $request->story_id,
            'order'    => $request->order,
            'text'     => $request->text,
            'background_id1' => $request->background_id1,
            'background_id2' => $request->background_id2,
            'character_image1_id' => $request->character_image1_id,
            'character_image2_id' => $request->character_image2_id,
            'character_image3_id' => $request->character_image3_id,
            'balloon_id' => $request->balloon_id,
        ]);

        return redirect()->route('scenes.index', ['story_id' => $request->story_id])
            ->with('success', 'シーンを作成しました！');
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
    public function edit($id)
    {
        $scene = Scene::whereHas('story', function ($q) {
            $q->where('created_by', auth()->id());
        })->findOrFail($id);

        $characters = Character::where('created_by', auth()->id())->get();
        $balloons   = Balloon::where('user_id', auth()->id())->get();
        $backgrounds = Background::where('user_id', auth()->id())->get();

        return view('scenes.edit', compact('scene', 'characters', 'balloons', 'backgrounds'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {   
        $scene = Scene::whereHas('story', function ($q) {
            $q->where('created_by', auth()->id());
        })->findOrFail($id);

        $scene->update([
            'background_id1' => $request->background_id1,
            'background_id2' => $request->background_id2,
            'character_image1_id' => $request->character_image1_id,
            'character_image2_id' => $request->character_image2_id,
            'character_image3_id' => $request->character_image3_id,
            'balloon_id' => $request->balloon_id,
            'text' => $request->text,
        ]);

        return redirect()->route('scenes.edit', $scene->id)
            ->with('success', 'シーンを更新しました！');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $scene = Scene::whereHas('story', function ($q) {
            $q->where('created_by', auth()->id());
        })->findOrFail($id);

        $story_id = $scene->story_id;

        // まず削除
        $scene->delete();

        // 残ったシーンの order を詰め直す
        $scenes = Scene::where('story_id', $story_id)
            ->orderBy('order')
            ->get();

        $newOrder = 1;
        foreach ($scenes as $s) {
            $s->order = $newOrder;
            $s->save();
            $newOrder++;
        }

        return redirect()->route('scenes.index', ['story_id' => $story_id])
            ->with('success', 'シーンを削除しました！');
    }

    public function play($story_id)
    {
        // 最初のシーンを取得
        $scene = Scene::where('story_id', $story_id)
            ->orderBy('order')
            ->first();

        return redirect()->route('stories.play.scene', [
            'story' => $story_id,
            'order' => $scene->order
        ]);
        }

    public function playScene($story_id, $order)
    {
        $scene = Scene::where('story_id', $story_id)
            ->where('order', $order)
            ->firstOrFail();

        // 次のシーンがあるかチェック
        $nextScene = Scene::where('story_id', $story_id)
            ->where('order', '>', $order)
            ->orderBy('order')
            ->first();

        return view('scenes.play', compact('scene', 'nextScene'));
    }


}
