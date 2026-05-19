<h1>バルーンを追加</h1>

<form action="{{ route('balloons.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div>
        <label>バルーン名</label>
        <input type="text" name="name" value="{{ old('name') }}" required>
    </div>

    <div>
        <label>バルーン画像</label>
        <input type="file" name="image" required>
    </div>

    <div>
        <label>キャラ専用バルーンにする？</label>
        <select name="character_id">
            <option value="">全キャラ共通</option>
            @foreach ($characters as $character)
                <option value="{{ $character->id }}">{{ $character->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit">追加する</button>
</form>

<a href="{{ route('balloons.index') }}">← バルーン一覧に戻る</a>
