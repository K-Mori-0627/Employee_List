@extends('layouts.user.Base')

@section('Title', 'お知らせ一覧')

@section('content')
    <br />
    <div class="container wrapper">
        <h2 class="heading" data-en="Information"><i class="fa fa-home"></i><span> お知らせ一覧</span></h2>

        <div class="ttl"><i class="fas fa-info-circle"></i> お知らせ</div>
        <div class="topics">
            @if($mixInfo->count() > 0)
                @foreach($mixInfo as $Item)
                    <dl>
                        <dt>{{ date('Y/m/d H:i',  strtotime($Item['created_at'])) }}</dt>
                        <dd>{{ $Item['title'] }}</dd>
                        <dd>{{ $Item['text'] }}</dd>
                    </dl>
                @endforeach
            @else
                <span>お知らせはありません。</span>
            @endif
        </div>
    </div>
@endsection
