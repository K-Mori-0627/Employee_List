@extends('layouts.admin.Base')

@section('Title', '社員編集')

@section('content')
    <br />
    <div class="container wrapper">
        <h2 class="heading" data-en="Employee Edit"><i class="fas fa-edit"></i><span> 社員編集</span></h2>
        <br />
        <form action="{{ route('admin.employee.update', ['employee' => $mixProfile['employee_id']]) }}" method="POST" autocomplete="off">
            @method('PUT')
            @csrf
            <h6 class="sub_line" style="text-align:left;">社員情報</h6>
            <div class="row mb-3">
                <div class="col-lg-6 col-md-6 mb-3">
                    <h6 style="text-align:left;"><i class="fa fa-user-alt"></i> 名前（かな） <span class="badge badge-danger">必須</span></h6>
                    {{ Form::Text('name_kana', $mixProfile['name_kana'], $errors->has('name_kana') ? ['class' => 'form-control is-invalid']
                                                                                                   : ['class' => 'form-control']) }}
                    @error('name_kana')
                        <span class="invalid-feedback float-left" role="alert">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-6 col-md-6 mb-3">
                    <h6 style="text-align:left;"><i class="fa fa-user-alt"></i> 名前（英字） <span class="badge badge-danger">必須</span></h6>
                    {{ Form::Text('name_roma', $mixProfile['name_roma'], $errors->has('name_roma') ? ['class' => 'form-control is-invalid']
                                                                                                   : ['class' => 'form-control']) }}
                    @error('name_roma')
                        <span class="invalid-feedback float-left" role="alert">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-6 col-md-6 mb-3">
                    <h6 style="text-align:left;"><i class="fa fa-envelope"></i> メールアドレス <span class="badge badge-danger">必須</span></h6>
                    {{ Form::Text('email', $mixProfile['email'], $errors->has('email') ? ['class' => 'form-control is-invalid']
                                                                                       : ['class' => 'form-control']) }}
                    @error('email')
                        <span class="invalid-feedback float-left" role="alert">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-6 col-md-6 mb-3">
                    <h6 style="text-align:left;"><i class="fas fa-id-card-alt"></i> ログインID <span class="badge badge-danger">必須</span></h6>
                    <div class="input-group">
                        {{ Form::Text('login_id', $mixProfile['login_id'], $errors->has('login_id') ? ['class' => 'form-control is-invalid']
                                                                                                    : ['class' => 'form-control']) }}
                        <div class="input-group-append">
                            <button class="btn btn-primary btn-id" type="button"><i class="fa fa-pen"></i>ログインID生成</button>
                        </div>
                        @error('login_id')
                            <span class="invalid-feedback float-left" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 mb-3">
                    <h6 style="text-align:left;"><i class="fa fa-user-plus"></i> 役職 <span class="badge badge-danger">必須</span></h6>
                    {{ Form::Select('role', $aryRoleData, $mixProfile['role'], $errors->has('role') ? ['class' => 'form-control is-invalid']
                                                                                                    : ['class' => 'form-control']) }}
                    @error('role')
                        <span class="invalid-feedback float-left" role="alert">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-6 col-md-6 mb-3">
                    <h6 style="text-align:left;"><i class="fa fa-user-plus"></i> 部署 <span class="badge badge-danger">必須</span></h6>
                    {{ Form::Select('department', $aryDptData, $mixProfile['department'], $errors->has('department') ? ['class' => 'form-control is-invalid']
                                                                                                                     : ['class' => 'form-control']) }}
                    @error('department')
                        <span class="invalid-feedback float-left" role="alert">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-6 col-md-6 mb-3">
                    <h6 style="text-align:left;"><i class="fas fa-key"></i> パスワード</h6>
                    <div class="input-group">
                        {{ Form::Text('password_update', null, $errors->has('password_update') ? ['class' => 'form-control is-invalid']
                                                                                               : ['class' => 'form-control']) }}
                        <div class="input-group-append">
                            <button class="btn btn-primary btn-pw" type="button"><i class="fa fa-pen"></i>パスワード生成</button>
                        </div>
                        @error('password_update')
                            <span class="invalid-feedback float-left" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div align="center">
                <button type="button" class="btn btn-primary col-5 col-md-5" data-toggle="modal" data-target="#Modal">登録</button>
                <button type="button" class="btn btn-secondary col-5 col-md-5" onclick="location.href='{{ route('admin.employee.index') }}'">キャンセル</button>
            </div>

            {{-- モーダル --}}
            <div class="modal fade" data-backdrop="static" id="Modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">社員編集</h5>
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
<script type="module">
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
