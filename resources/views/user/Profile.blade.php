@extends('layouts.user.Base')

@section('Title', 'プロフィール')

@section('content')
    <br />
    <div class="container wrapper">
        <h2 class="heading" data-en="Profile"><i class="fa fa-user-circle"></i><span> プロフィール</span></h2>
        <div align="center">
            @if (is_null($mixProfile['profile_img']))
            <img class="profile-img" src="{{ asset('img/image.png') }}">
            @else
            <img class="profile-img" src="{{ $mixProfile['profile_img'] }}">
            @endif
            <br /><br />
            <p>{{ $mixProfile['name_kana'] }}<br />{{"（".$mixProfile['name_roma']."）" }}</p>
            <h6 class="sub_line" style="text-align:left;">社員情報</h6>
            <div class="row mb-3">
                <div class="col-lg-6 col-md-6">
                    <h6 style="text-align:left;"><i class="fa fa-address-book"></i> 社員ID</h6>
                    <p class="under_line">{{ $mixProfile['employee_id'] }}</p>
                </div>
                <div class="col-lg-6 col-md-6">
                    <h6 style="text-align:left;"><i class="fa fa-user-plus"></i> 役職</h6>
                    <p class="under_line">{{ $mixProfile['caption'] }}</p>
                </div>
                <div class="col-lg-6 col-md-6">
                    <h6 style="text-align:left;"><i class="fas fa-handshake"></i> 入社日</h6>
                    <p class="under_line">{{ date('Y/m/d', strtotime($mixProfile['created_at'])) }}</p>
                </div>
            </div>
            <h6 class="sub_line" style="text-align:left;">プロフィール</h6>
            <div class="row mb-3">
                <div class="col-lg-6 col-md-6">
                    <h6 style="text-align:left;"><i class="fa fa-birthday-cake"></i> 誕生日</h6>
                    <p class="under_line">{{ $mixProfile['birthday'] }}</p>
                </div>
                <div class="col-lg-6 col-md-6">
                    <h6 style="text-align:left;"><i class="fa fa-desktop"></i> 得意な技術</h6>
                    <p class="under_line">{{ $mixProfile['technology'] }}</p>
                </div>
                <div class="col-lg-6 col-md-6">
                    <h6 style="text-align:left;"><i class="fa fa-book"></i> 趣味</h6>
                    <p class="under_line">{{ $mixProfile['hobby'] }}</p>
                </div>
                <div class="col-lg-6 col-md-6">
                    <h6 style="text-align:left;"><i class="fa fa-comment-dots"></i> フリースペース</h6>
                    <p class="under_line">{{ $mixProfile['freespace'] }}</p>
                </div>
            </div>
            @if (Auth::user()->employee_id == $mixProfile['employee_id'])
            <a href="{{ route('user.profile.edit', ['profile' => $mixProfile['employee_id']]) }}" class="btn btn-primary col-5 col-md-5" style="margin-right: 10px;">プロフィール編集</a>
            <a href="{{ route('user.password.index') }}" class="btn btn-primary col-5 col-md-5" style="margin-right: 10px;">パスワード変更</a>
            <br /><br />
            @endif
        </div>
    </div>
@endsection
