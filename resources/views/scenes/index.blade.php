<h1>シーン一覧</h1>

{{-- ▶ プレイ画面へ行くリンク --}}
<div style="margin-bottom: 16px;">
    <a href="{{ route('stories.play', ['story' => $story_id]) }}">
        ▶ このストーリーをプレイする
    </a>
</div>

<a href="{{ route('scenes.create', ['story_id' => $story_id]) }}">
    ＋ 新しいシーンを作る
</a>

<table border="1" cellpadding="8">
    <tr>
        <th>シーン番号</th>
        <th>背景1</th>
        <th>背景2</th>
        <th>キャラ1</th>
        <th>キャラ2</th>
        <th>キャラ3</th>
        <th>バルーン</th>
        <th>テキスト</th>
        <th>操作</th>
    </tr>

    @foreach ($scenes as $scene)
        <tr>
            <td>{{ $scene->order}}</td>

            {{-- 背景1 --}}
            <td>
                @if ($scene->background1)
                    <img src="{{ asset('storage/' . $scene->background1->image_path) }}" width="80">
                @endif
            </td>

            {{-- 背景2 --}}
            <td>
                @if ($scene->background2)
                    <img src="{{ asset('storage/' . $scene->background2->image_path) }}" width="80">
                @endif
            </td>

            {{-- キャラ画像1 --}}
            <td>
                @if ($scene->characterImage1)
                    <img src="{{ asset('storage/' . $scene->characterImage1->image_path) }}" width="80">
                @endif
            </td>

            {{-- キャラ画像2 --}}
            <td>
                @if ($scene->characterImage2)
                    <img src="{{ asset('storage/' . $scene->characterImage2->image_path) }}" width="80">
                @endif
            </td>

            {{-- キャラ画像3 --}}
            <td>
                @if ($scene->characterImage3)
                    <img src="{{ asset('storage/' . $scene->characterImage3->image_path) }}" width="80">
                @endif
            </td>

            {{-- バルーン --}}
            <td>
                @if ($scene->balloon)
                    <img src="{{ asset('storage/' . $scene->balloon->image_path) }}" width="80">
                @endif
            </td>

            {{-- テキスト --}}
            <td>{{ Str::limit($scene->text, 30) }}</td>

            {{-- 操作 --}}
            <td>
                <a href="{{ route('scenes.edit', $scene->id) }}">編集</a>

                {{-- 削除ボタン --}}
                <form action="{{ route('scenes.destroy', $scene->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('本当に削除しますか？')">
                        削除
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
