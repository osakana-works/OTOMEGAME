<h1>シーンを新しく作る</h1>

<form action="{{ route('scenes.store') }}" method="POST">
    @csrf

    {{-- ストーリーID（非表示） --}}
    <input type="hidden" name="story_id" value="{{ $story_id }}">

    {{-- 順番（order）も非表示 --}}
    <input type="hidden" name="order" value="{{ $nextOrder }}">

    {{-- 背景1 --}}
    <div>
        <label>背景画像1</label>
        <select name="background_id1">
            <option value="">選択しない</option>
            @foreach ($backgrounds as $bg)
                <option value="{{ $bg->id }}">{{ $bg->name }}</option>
            @endforeach
        </select>
    </div>

    {{-- 背景2 --}}
    <div>
        <label>背景画像2</label>
        <select name="background_id2">
            <option value="">選択しない</option>
            @foreach ($backgrounds as $bg)
                <option value="{{ $bg->id }}">{{ $bg->name }}</option>
            @endforeach
        </select>
    </div>

    {{-- キャラ画像1 --}}
    <div>
        <label>キャラ画像1</label>
        <select name="character_image1_id">
            <option value="">選択しない</option>
            @foreach ($characterImages as $img)
                <option value="{{ $img->id }}">
                    {{ $img->character->name }} : {{ $img->pose_name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- キャラ画像2 --}}
    <div>
        <label>キャラ画像2</label>
        <select name="character_image2_id">
            <option value="">選択しない</option>
            @foreach ($characterImages as $img)
                <option value="{{ $img->id }}">
                    {{ $img->character->name }} : {{ $img->pose_name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- キャラ画像3 --}}
    <div>
        <label>キャラ画像3</label>
        <select name="character_image3_id">
            <option value="">選択しない</option>
            @foreach ($characterImages as $img)
                <option value="{{ $img->id }}">
                    {{ $img->character->name }} : {{ $img->pose_name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- バルーン --}}
    <div>
        <label>バルーン</label>
        <select name="balloon_id">
            <option value="">選択しない</option>
            @foreach ($balloons as $balloon)
                <option value="{{ $balloon->id }}">{{ $balloon->name }}</option>
            @endforeach
        </select>
    </div>

    {{-- セリフ --}}
    <div>
        <label>セリフ</label>
        <textarea name="text" rows="4"></textarea>
    </div>

    <button type="submit">作成する</button>
</form>

<a href="{{ route('scenes.index', ['story_id' => $story_id]) }}">← シーン一覧に戻る</a>
