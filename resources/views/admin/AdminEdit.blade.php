@extends('layouts.admin.Base')

@section('Title', '管理者編集')

@section('content')
    <br />
    <div class="container wrapper">
        <h2 class="heading" data-en="Member Edit"><i class="fas fa-edit"></i><span> 管理者編集</span></h2>
        <br />
        <form action="{{ route('admin.home.update', ['home' => $mixAdmin['id']]) }}" method="POST" autocomplete="off">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="mb-3">
                        <h6 style="text-align:left;"><i class="fa fa-user-alt"></i> 名前 <span class="badge badge-danger">必須</span></h6>
                        {{ Form::Text('name', $mixAdmin['name'], $errors->has('name') ? ['class' => 'form-control is-invalid']
                                                                                      : ['class' => 'form-control']) }}
                        @error('name')
                        <span class="invalid-feedback float-left" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <h6 style="text-align:left;"><i class="fas fa-id-card-alt"></i> ログインID <span class="badge badge-danger">必須</span></h6>
                        <div class="input-group">
                            {{ Form::Text('login_id', $mixAdmin['login_id'], $errors->has('login_id') ? ['class' => 'form-control is-invalid']
                                                                                                      : ['class' => 'form-control']) }}
                            <div class="input-group-append">
                                <button class="btn btn-primary btn-id" type="button"><i class="fa fa-pen"></i>ログインID生成</button>
                            </div>
                            @error('login_id')
                            <span class="invalid-feedback float-left" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="mb-3">
                        <h6 style="text-align:left;"><i class="fas fa-key"></i> パスワード</h6>
                        <div class="input-group">
                            {{ Form::Text('password', null, $errors->has('password') ? ['class' => 'form-control is-invalid']
                                                                                     : ['class' => 'form-control']) }}
                            <div class="input-group-append">
                                <button class="btn btn-primary btn-pw" type="button"><i class="fa fa-pen"></i>パスワード生成</button>
                            </div>
                            @error('password')
                            <span class="invalid-feedback float-left" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <br />
            <div class="mb-3" align="center">
                <button type="button" class="btn btn-primary col-5 col-md-5" data-toggle="modal" data-target="#Modal">登録</button>
                <button type="button" class="btn btn-secondary col-5 col-md-5" onclick="location.href='{{ route('admin.home.index') }}'">キャンセル</button>
            </div>

            {{-- モーダル --}}
            <div class="modal fade" data-backdrop="static" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">管理者編集</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            入力した内容で登録しますか？
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary col-4 col-md-4">登録</button>
                            <button type="button" class="btn btn-secondary col-4 col-md-4" data-dismiss="modal">キャンセル</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
<script type="text/javascript">
    $(function() {
        $(".btn-pw").click(function() {
            var letters = 'abcdefghijklmnopqrstuvwxyz';
            var numbers = '0123456789';
            var string  = letters + letters.toUpperCase() + numbers;
            var len = 8;
            var password='';
            for (var i = 0; i < len; i++) {
                password += string.charAt(Math.floor(Math.random() * string.length));
            }
            $('[name="password"]').val(password);
        });
        $(".btn-id").click(function() {
            var letters = 'abcdefghijklmnopqrstuvwxyz';
            var numbers = '0123456789';
            var string  = letters + letters.toUpperCase() + numbers;
            var len = 8;
            var id = '';
            for (var i = 0; i < len; i++) {
                id += string.charAt(Math.floor(Math.random() * string.length));
            }
            $('[name="login_id"]').val(id);
        });
    });
</script>
@endsection
