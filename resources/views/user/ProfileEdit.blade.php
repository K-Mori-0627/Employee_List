@extends('layouts.user.Base')

@section('Title', 'プロフィール編集')

@section('content')
    <br />
    <div class="container wrapper">
        <h1><i class="fas fa-edit"></i> プロフィール編集</h1>
        <hr />
        <form action="{{ route('user.profile.update', ['profile' => Auth::user()->employee_id]) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @method('PUT')
            @csrf
            <div class="mb-3" align="center">
                <img class="profile-img" id="Preview" src="{{ asset($mixProfile['profile_img']) }}">
                <br/>
                <input type="file" name="image" id="ImageUpload" accept='image/*' style="display:none">
                {{ Form::Text('profile_img', $mixProfile['profile_img'], ['id' => 'ProfileImg', 'style' => 'display:none']) }}
                <br />
                <button class="btn btn-primary" id="ImageUploadButton">画像を選択</button>
            </div>
            <h6 class="sub_line" style="text-align:left;">社員情報</h6>
            <div class="row mb-3">
                <div class="col-lg-6 col-md-6 mb-3">
                    <h6 style="text-align:left;"><i class="fas fa-id-card-alt"></i> ログインID <span class="badge badge-danger">必須</span></h6>
                    {{ Form::Text('login_id', $mixProfile['login_id'], ['class' => 'form-control']) }}
                </div>
            </div>
            <h6 class="sub_line" style="text-align:left;">プロフィール</h6>
            <div class="row mb-3">
                <div class="col-lg-6 col-md-6 mb-3">
                    <h6 style="text-align:left;"><i class="fa fa-birthday-cake"></i> 誕生日</h6>
                    {{ Form::Date('birthday', $mixProfile['birthday'], ['class' => 'form-control']) }}
                </div>
                <div class="col-lg-6 col-md-6 mb-3">
                    <h6 style="text-align:left;"><i class="fa fa-desktop"></i> 得意な技術</h6>
                    {{ Form::Text('technology', $mixProfile['technology'], ['class' => 'form-control']) }}
                </div>
                <div class="col-lg-6 col-md-6 mb-3">
                    <h6 style="text-align:left;"><i class="fa fa-book"></i> 趣味</h6>
                    {{ Form::Textarea('hobby', $mixProfile['hobby'], ['class' => 'form-control', 'rows' => '3']) }}
                </div>
                <div class="col-lg-6 col-md-6 mb-3">
                    <h6 style="text-align:left;"><i class="fa fa-comment-dots"></i> フリースペース</h6>
                    {{ Form::Textarea('freespace', $mixProfile['freespace'], ['class' => 'form-control', 'rows' => '3']) }}
                </div>
            </div>
            <div class="mb-3" align="center">
                <button type="button" class="btn btn-primary col-5 col-md-5" data-toggle="modal" data-target="#Modal">登録</button>
                <button type="button" class="btn btn-secondary col-5 col-md-5" onclick="location.href='{{ route('user.profile.show', ['profile' => Auth::user()->employee_id]) }}'">キャンセル</button>
            </div>

            {{-- モーダル --}}
            <div class="modal fade" data-backdrop="static" id="Modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">プロフィール編集</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            入力した内容で登録しますか？
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary col-4 col-md-4">変更</button>
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
        $('#ImageUpload').on('change', function (e) {
            let reader = new FileReader();
            reader.onload = function (e) {
                $("#Preview").attr('src', e.target.result);
                $("#ProfileImg").attr('value', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });

        $('#ImageUploadButton').click(function(){
            $('#ImageUpload').click();
            return false;
        });
    });
</script>
@endsection
