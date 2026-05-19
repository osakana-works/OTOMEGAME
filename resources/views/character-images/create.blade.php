<h1>キャラ画像追加</h1>

<form action="{{ route('character-images.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    {{-- キャラID（hidden） --}}
    <input type="hidden" name="character_id" value="{{ request('character_id') }}">

    <div>
        <label>ポーズ名（例：笑顔、怒り、照れ）</label>
        <input type="text" name="pose_name" value="{{ old('pose_name') }}">
    </div>

    <div>
        <label>画像ファイル</label>
        <input type="file" name="image" required>
    </div>

    <button type="submit">追加する</button>
</form>

<a href="{{ route('characters.edit', request('character_id')) }}">← キャラ編集に戻る</a>
