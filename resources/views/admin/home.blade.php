@extends('layouts.admin.Base')

@section('Title', 'ホーム')

@section('content')
    <br />
    <div class="container wrapper">
        <h2 class="heading" data-en="Home"><i class="fa fa-home"></i><span> ホーム</span></h2>
        <div class="ttl mb-3"><i class="fa fa-users"></i> 管理者検索</div>
        <div class="card mb-3">
            <div class="card-header"><i class="fas fa-search"></i> 検索条件</div>
            <div class="card-body">
                <form action="" method="POST" autocomplete="off">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-lg-6 col-md-6 mb-3">
                            <h6 style="text-align:left;"><i class="fa fa-address-book"></i> ID</h6>
                            {{ Form::Text('employee_id', null, ['class' => 'form-control']) }}
                        </div>
                        <div class="col-lg-6 col-md-6 mb-3">
                            <h6 style="text-align:left;"><i class="fa fa-user-alt"></i> 名前</h6>
                            {{ Form::Text('name', null, ['class' => 'form-control']) }}
                        </div>
                        <div class="col-lg-6 col-md-6 mb-3">
                            <h6 style="text-align:left;"><i class="far fa-clock"></i> 登録日 From〜To</h6>
                            <div class="input-group">
                                {{ Form::Date('date_from', null, ['class' => 'form-control']) }}
                                <div class="input-group-prepend">
                                    <span class="input-group-text">〜</span>
                                </div>
                                {{ Form::Date('date_to', null, ['class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>
                    <div align="center">
                        <button type="button" class="btn btn-primary col-2 col-md-2" data-toggle="modal" data-target="#Modal">検索</button>
                        <button type="reset" class="btn btn-secondary col-2 col-md-2">クリア</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="ttl mb-3"><i class="fa fa-users"></i> 管理者一覧</div>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-sm text-nowrap table-dark">
                <thead class="thead-dark">
                    <tr>
                        <th><i class="fa fa-address-book"></i> @sortablelink('id', 'ID')</th>
                        <th><i class="fa fa-user-alt"></i> @sortablelink('name', '名前')</th>
                        <th><i class="far fa-clock"></i> @sortablelink('created_at', '登録日')</th>
                        <th colspan="2"><i class="far fa-hand-paper"></i> 操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mixAdmins as $Item)
                        <tr>
                            <td>{{ sprintf('%03d', $Item['id']) }}</td>
                            <td>{{ $Item['name'] }}</td>
                            <td>{{ date('Y/m/d', strtotime($Item['created_at'])) }}</td>
                            <td align="center">
                                <button class="btn btn-success btn-sm" type="button" onclick="location.href='{{ route('admin.home.edit', ['home' => $Item['id']]) }}'"><i class="fa fa-pen"></i> 編集</button>
                                <button class="btn btn-danger btn-sm" type="button" data-toggle="modal" data-target="#modal_delete" data-title="{{ $Item['name'] }}" data-url="{{ route('admin.home.destroy', ['home' => $Item['id']]) }}"><i class="fa fa-trash-alt"></i> 削除</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $mixAdmins->appends(request()->query())->links() }}
        </div>

        {{-- モーダル --}}
        <div class="modal fade" data-backdrop="static" id="modal_delete" tabindex="-1" role="dialog" aria-hidden="true">
            <form method="POST" action="">
                @method('DELETE')
                @csrf
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">ユーザー削除</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            以下のユーザーを削除しますか？
                            <p></p>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger col-4 col-md-4">削除</button>
                            <button type="button" class="btn btn-secondary col-4 col-md-4" data-dismiss="modal">キャンセル</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script type="module">
        $('#modal_delete').on('shown.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var title = button.data('title');
            var url = button.data('url');
            var modal = $(this);
            modal.find('.modal-body p').eq(0).text('名前：' + title);
            modal.find('form').attr('action', url);
        });
    </script>
@endsection
