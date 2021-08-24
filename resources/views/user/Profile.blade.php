@extends('layouts.user.Base')

@section('Title', 'プロフィール')

@section('content')
    <br />
    <div class="container wrapper">
        <h2 class="heading" data-en="Profile"><i class="fa fa-user-circle"></i><span> プロフィール</span></h2>
        <div align="center">
            <p>{{ $mixProfile['Dept'] }}</p>
            <img class="profile-img" src="{{ asset($mixProfile['profile_img']) }}">
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
                    <p class="under_line">{{ $mixProfile['Role'] }}</p>
                </div>
                <div class="col-lg-6 col-md-6">
                    <h6 style="text-align:left;"><i class="fas fa-handshake"></i> 入社日</h6>
                    <p class="under_line">{{ date('Y/m/d', strtotime($mixProfile['created_at'])) }}</p>
                </div>
                <div class="col-lg-6 col-md-6">
                    <h6 style="text-align:left;"><i class="fas fa-envelope"></i> メールアドレス</h6>
                    <p class="under_line">{{ $mixProfile['email'] }}</p>
                </div>
            </div>
            <h6 class="sub_line" style="text-align:left;">プロフィール</h6>
            <div class="row mb-3">
                <div class="col-lg-6 col-md-6">
                    <h6 style="text-align:left;"><i class="fa fa-birthday-cake"></i> 誕生日</h6>
                    <p class="under_line">
                        {{ date('Y/m/d', strtotime($mixProfile['birthday'])) }}
                    </p>
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
                <div class="mb-3" align="center">
                    <button type="button" class="btn btn-primary col-5 col-md-5" onclick="location.href='{{ route('user.profile.edit', ['profile' => $mixProfile['employee_id']]) }}'">プロフィール編集</button>
                    <button type="button" class="btn btn-primary col-5 col-md-5" onclick="location.href='{{ route('user.password.index') }}'">パスワード変更</button>
                </div>
            @endif
        </div>
    </div>
@endsection
