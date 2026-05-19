{{-- 再生画面（960×540固定） --}}
<div style="
    position: relative;
    width: 960px;
    height: 540px;
    margin: 0 auto;
    background: #000;
    overflow: hidden;
">

    {{-- 背景1 --}}
    @if ($scene->background1)
        <img src="{{ asset('storage/' . $scene->background1->image_path) }}"
             style="position:absolute; width:100%; height:100%; object-fit:cover;">
    @endif

    {{-- 背景2 --}}
    @if ($scene->background2)
        <img src="{{ asset('storage/' . $scene->background2->image_path) }}"
             style="position:absolute; width:100%; height:100%; object-fit:cover;">
    @endif

    {{-- キャラ1 --}}
    @if ($scene->characterImage1)
        <img src="{{ asset('storage/' . $scene->characterImage1->image_path) }}"
             style="position:absolute; bottom:0; left:10%;">
    @endif

    {{-- キャラ2 --}}
    @if ($scene->characterImage2)
        <img src="{{ asset('storage/' . $scene->characterImage2->image_path) }}"
             style="position:absolute; bottom:0; left:40%;">
    @endif

    {{-- キャラ3 --}}
    @if ($scene->characterImage3)
        <img src="{{ asset('storage/' . $scene->characterImage3->image_path) }}"
             style="position:absolute; bottom:0; left:70%;">
    @endif

    {{-- バルーン --}}
    @if ($scene->balloon)
        <img src="{{ asset('storage/' . $scene->balloon->image_path) }}"
             style="position:absolute; bottom:150px; left:50px;">
    @endif

    {{-- テキスト --}}
    <div style="
        position:absolute;
        bottom:20px;
        left:20px;
        right:20px;
        background:rgba(0,0,0,0.5);
        color:white;
        padding:20px;
        font-size:20px;
    ">
        {{ $scene->text }}
    </div>

</div>

{{-- 次へ進むボタン --}}
@if ($nextScene)
    <div style="text-align:center; margin-top:20px;">
        <a href="{{ route('stories.play.scene', ['story' => $scene->story_id, 'order' => $nextScene->order]) }}">
            次へ進む
        </a>
    </div>
@else
    <p style="text-align:center; margin-top:20px;">ここでストーリーは終わりです！</p>
@endif
