<h1>背景画像を追加</h1>

<form action="{{ route('backgrounds.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div>
        <label>背景名</label>
        <input type="text" name="name" required>
    </div>

    <div>
        <label>背景画像ファイル</label>
        <input type="file" name="image" required>
    </div>

    <button type="submit">追加する</button>
</form>

<a href="{{ route('backgrounds.index') }}">← 背景一覧に戻る</a>
