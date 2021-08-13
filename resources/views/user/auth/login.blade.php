@extends('layouts.user.LoginBase')

@section('content')
    <form class="form-signin" action="{{ route('user.login') }}" method="POST" autocomplete="off">
        @csrf
        <div class="text-center mb-4">
            <h1>Employee List</h1>
        </div>

        <div class="form-label-group">
            <input type="text" id="inputEmail" name="login_id" class="form-control" placeholder="LoginID" required autofocus>
            <label for="inputRoginId">LoginID</label>
        </div>

        <div class="form-label-group">
            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
            <span class="field-icon"><i toggle="password-field" class="fas fa-eye toggle-password"></i></span>
            <label for="inputPassword">Password</label>
        </div>

        <div class="form-group ">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">ログイン状態を保持する</label>
            </div>
        </div>

        <button class="btn-lg btn-primary btn-block" type="submit">ログイン</button>
        <p class="mt-5 mb-3 text-center"><i class="far fa-copyright"></i> 2021 Employee List Ver.1.0.1</p>
    </form>
@endsection
