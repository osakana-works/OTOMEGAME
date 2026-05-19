<h1>ストーリー一覧</h1>

<form method="POST" action='/stories'>
    @csrf
    <input type="text" name="title" placeholder="ストーリー名">
    <div>
        <label>説明</label>
        <textarea name="description"></textarea>
    </div>
    <button type="submit">作成</button>
</form>


<ul>
@foreach($stories as $story)
    <li>
        {{ $story->title }}
        {{ $story->description }}
        
        <a href="{{ route('scenes.index', ['story_id' => $story->id]) }}">
            シーン一覧へ
        </a>
        <form method="POST" action="{{ route('stories.destroy', $story) }}" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">削除</button>
        </form>
    </li>
@endforeach
</ul>
