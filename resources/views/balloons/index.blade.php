<h1>バルーン一覧</h1>

<a href="{{ route('balloons.create') }}">＋ バルーンを追加</a>

<div style="margin-top:20px;">
    @foreach ($balloons as $balloon)
        <div style="margin-bottom:20px; border:1px solid #ccc; padding:10px; width:300px;">
            <p>{{ $balloon->name }}</p>

            <img src="/storage/{{ $balloon->image_path }}" width="200">

            {{-- 編集 --}}
            <a href="{{ route('balloons.edit', $balloon->id) }}">編集</a>

            {{-- 削除 --}}
            <form action="{{ route('balloons.destroy', $balloon->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">削除</button>
            </form>
        </div>
    @endforeach
</div>
