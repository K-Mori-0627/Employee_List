@extends('layouts.user.Base')

@section('Title', 'パスワード変更')

@section('content')
    <br />
    <div class="container wrapper">
        <h1><i class="fa fa-key"></i> パスワード変更</h1>
        <hr />
        <form action="{{ route('user.password.update', ['password' => Auth::user()->employee_id]) }}" method="POST" autocomplete="off">
            @method('PUT')
            @csrf
            <div align="center">
                <div class="col-lg-6 col-md-6">
                    <div class="mb-3">
                        <h6 style="text-align:left;"><b>現在のパスワード</b> <span class="badge badge-danger">必須</span></h6>
                        {{ Form::Password('current', $errors->has('current') ? ['class' => 'form-control is-invalid', 'id' => 'current', 'placeholder' => '現在のパスワード']
                                                                             : ['class' => 'form-control', 'id' => 'current', 'placeholder' => '現在のパスワード']) }}
                        <span class="field-icon"><i toggle="password-field" class="fas fa-eye toggle-password"></i></span>
                        @error('current')
                            <span class="invalid-feedback float-left" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <h6 style="text-align:left;"><b>新しいパスワード</b> <span class="badge badge-danger">必須</span></h6>
                        {{ Form::Password('password', $errors->has('password') ? ['class' => 'form-control is-invalid', 'id' => 'password', 'placeholder' => '新しいパスワード']
                                                                               : ['class' => 'form-control', 'id' => 'password', 'placeholder' => '新しいパスワード']) }}
                        <span class="field-icon"><i toggle="password-field" class="fas fa-eye toggle-password"></i></span>
                        <span class="float-left">8文字以上15文字以下の半角英数字</span>
                        @error('password')
                            <span class="invalid-feedback float-left" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                    <br />
                    <div class="mb-3">
                        <h6 style="text-align:left;"><b>新しいパスワード(確認)</b> <span class="badge badge-danger">必須</span></h6>
                        {{ Form::Password('password_confirmation', ['class' => 'form-control', 'id' => 'password-confirm', 'placeholder' => '新しいパスワード(確認)']) }}
                        <span class="field-icon"><i toggle="password-field" class="fas fa-eye toggle-password"></i></span>
                        <span class="float-left">8文字以上15文字以下の半角英数字</span>
                    </div>
                    <br />
                </div>
                <br />
                <button type="button" class="btn btn-primary col-5 col-md-5" data-toggle="modal" data-target="#Modal">変更</button>
                <button type="button" class="btn btn-secondary col-5 col-md-5" onclick="location.href='{{ route('user.profile.show', ['profile' => Auth::user()->employee_id]) }}'">キャンセル</button>
            </div>

            {{-- モーダル --}}
            <div class="modal fade" data-backdrop="static" id="Modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">パスワード変更</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            入力したパスワードに変更しますか？
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary col-4 col-md-4">変更</button>
                            <button type="button" class="btn btn-secondary col-4 col-md-4" data-dismiss="modal">キャンセル</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <br /><br />
    </div>
@endsection

@section('script')
<script type="module">
    $(function() {
        $(".toggle-password").click(function () {
            $(this).toggleClass("fa-eye fa-eye-slash");

            let input = $(this).parent().prev("input");

            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    });
</script>
@endsection
