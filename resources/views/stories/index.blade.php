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
        <a href="{{--route('stories.edit', $story) --}}">編集</a>
    </li>
@endforeach
</ul>
