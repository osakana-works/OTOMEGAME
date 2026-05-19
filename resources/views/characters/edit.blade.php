<h1>キャラクター編集</h1>

<form method="POST" action="{{ route('characters.update', $character) }}">
    @csrf
    @method('PUT')

    <div>
        <label>キャラクター名</label>
        <input type="text" name="name" value="{{ $character->name }}" required>
    </div>

    <div>
        <label>説明</label>
        <textarea name="description">{{ $character->description }}</textarea>
    </div>

    <button type="submit">更新</button>
</form>

<hr>

<h2>キャラクター画像</h2>

{{-- 画像追加ボタン --}}
<a href="{{ route('character-images.create') }}?character_id={{ $character->id }}">
    ＋ 画像を追加
</a>

<ul>
@foreach($character->images as $img)
    <li style="margin-bottom: 20px;">
        <strong>{{ $img->pose_name }}</strong><br>

        {{-- 画像表示 --}}
        <img src="/storage/{{ $img->image_path }}" style="height: 120px; object-fit: contain;">

        {{-- 編集 --}}
        <a href="{{ route('character-images.edit', $img->id) }}">編集</a>

        {{-- 削除 --}}
        <form action="{{ route('character-images.destroy', $img->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">削除</button>
        </form>
    </li>
@endforeach
</ul>
