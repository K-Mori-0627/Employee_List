@extends('layouts.admin.Base')

@section('Title', 'お知らせ編集')

@section('content')
    <br />
    <div class="container wrapper">
        <h2 class="heading" data-en="Information"><i class="fas fa-edit"></i><span> お知らせ登録</span></h2>
        <br />
        <form action="{{ route('admin.information.store') }}" method="POST" autocomplete="off">
            @csrf
            <label>タイトル <span class="badge badge-danger">必須</span></label>
            {{ Form::Text('title', null, $errors->has('title') ? ['class' => 'form-control is-invalid']
                                                                : ['class' => 'form-control mb-3']) }}
            @error('title')
            <span class="invalid-feedback float-left" role="alert">{{ $message }}</span>
            @enderror
            <label>本文 <span class="badge badge-danger">必須</span></label>
            {{ Form::Textarea('text', null, $errors->has('text') ? ['class' => 'form-control is-invalid']
                                                                 : ['class' => 'form-control mb-3']) }}
            @error('text')
            <span class="invalid-feedback float-left" role="alert">{{ $message }}</span>
            @enderror
            <div align="center">
                <button type="button" class="btn btn-primary col-5 col-md-5" data-toggle="modal" data-target="#Modal">登録</button>
                <button type="button" class="btn btn-secondary col-5 col-md-5" onclick="location.href='{{ route('admin.information.index') }}'">キャンセル</button>
            </div>

            {{-- モーダル --}}
            <div class="modal fade" data-backdrop="static" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">お知らせ登録</h5>
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
