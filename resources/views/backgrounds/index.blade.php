<h1>背景一覧</h1>

<a href="{{ route('backgrounds.create') }}">＋ 背景を追加</a>

<div>
    @foreach ($backgrounds as $bg)
        <div>
            <p>{{ $bg->name }}</p>
            <img src="/storage/{{ $bg->image_path }}" width="200">

            <form action="{{ route('backgrounds.destroy', $bg->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">削除</button>
        </form>
        </div>
    @endforeach
</div>
