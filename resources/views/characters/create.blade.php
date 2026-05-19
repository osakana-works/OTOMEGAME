<h1>キャラクター作成</h1>

<form method="POST" action="{{ route('characters.store') }}">
    @csrf
    @
    <div>
        <label>キャラクター名</label>
        <input type="text" name="name" placeholder="キャラクター名を入力" required>
    </div>

    <div>
        <label>説明</label>
        <textarea name="description" placeholder="キャラクターの説明を入力"></textarea>
    </div>

    <button type="submit">作成</button>
</form>
