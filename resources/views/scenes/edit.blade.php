<h1>シーン編集</h1>

<form action="{{ route('scenes.update', $scene->id) }}" method="POST">
    @csrf
    @method('PUT')

    {{-- 背景 --}}
    <div>
        <label>背景</label>
        <select name="background_id">
            @foreach ($backgrounds as $bg)
                <option value="{{ $bg->id }}" {{ $scene->background_id == $bg->id ? 'selected' : '' }}>
                    {{ $bg->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- キャラ1 --}}
    <div>
        <label>キャラ1</label>
        <select name="character1_id">
            <option value="">なし</option>
            @foreach ($characters as $ch)
                <option value="{{ $ch->id }}" {{ $scene->character1_id == $ch->id ? 'selected' : '' }}>
                    {{ $ch->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- キャラ2 --}}
    <div>
        <label>キャラ2</label>
        <select name="character2_id">
            <option value="">なし</option>
            @foreach ($characters as $ch)
                <option value="{{ $ch->id }}" {{ $scene->character2_id == $ch->id ? 'selected' : '' }}>
                    {{ $ch->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- キャラ3 --}}
    <div>
        <label>キャラ3</label>
        <select name="character3_id">
            <option value="">なし</option>
            @foreach ($characters as $ch)
                <option value="{{ $ch->id }}" {{ $scene->character3_id == $ch->id ? 'selected' : '' }}>
                    {{ $ch->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- バルーン --}}
    <div>
        <label>バルーン</label>
        <select name="balloon_id">
            <option value="">なし</option>
            @foreach ($balloons as $balloon)
                <option value="{{ $balloon->id }}" {{ $scene->balloon_id == $balloon->id ? 'selected' : '' }}>
                    {{ $balloon->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- セリフ --}}
    <div>
        <label>セリフ</label>
        <textarea name="text" rows="4">{{ $scene->text }}</textarea>
    </div>

    <button type="submit">保存する</button>
</form>
