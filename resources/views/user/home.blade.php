@extends('layouts.user.Base')

@section('Title', 'ホーム')

@section('content')
    <br />
    <div class="container wrapper">
        <h2 class="heading" data-en="Home"><i class="fa fa-home"></i><span> ホーム</span></h2>

        <div class="ttl"><i class="fas fa-info-circle"></i> お知らせ</div>
        <div class="topics">
            @if($mixInfo->count() > 0)
            @foreach($mixInfo as $Item)
			<dl>
                <dt>{{ date('Y/m/d H:i',  strtotime($Item['created_at'])) }}</dt>
                <dd>{{ $Item['title'] }}</dd>
            </dl>
            @endforeach
            @else
            <span>お知らせはありません。</span>
            @endif
        </div>
        <a href="{{ route('user.information.index') }}" class="float-right">お知らせ一覧</a>

        <div class="ttl"><i class="fa fa-users"></i> 社員内訳</div>
        <br/>
        <p>社員数：{{ $mixMemberCnt }}</p>
    </div>
@endsection
