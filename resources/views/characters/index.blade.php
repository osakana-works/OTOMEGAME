<h1>キャラクター一覧</h1>

<a href="{{ route('characters.create') }}">＋ キャラクターを作成</a>

<ul>
@foreach($characters as $character)
    <li>
        <strong>{{ $character->name }}</strong>
        <p>{{ $character->description }}</p>

        <a href="{{-- route('characters.edit', $character) --}}">編集</a>

        <form action="{{ route('characters.destroy', $character) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">削除</button>
        </form>
    </li>
@endforeach
</ul>
