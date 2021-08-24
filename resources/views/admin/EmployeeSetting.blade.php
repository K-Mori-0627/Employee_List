@extends('layouts.admin.Base')

@section('Title', '社員設定')

@section('content')
    <br />
    <div class="container wrapper">
        <h2 class="heading" data-en="Employee List"><i class="fa fa-address-book"></i><span> 社員リスト</span></h2>
        <div class="ttl mb-3"><i class="fa fa-address-book"></i> 社員検索</div>
        <div class="card mb-3">
            <div class="card-header"><i class="fas fa-search"></i> 検索条件</div>
            <div class="card-body">
                <form action="" method="POST" autocomplete="off">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-lg-6 col-md-6 mb-3">
                            <h6 style="text-align:left;"><i class="fas fa-list-ol"></i> 社員ID</h6>
                            {{ Form::Text('employee_id', null, ['class' => 'form-control']) }}
                        </div>
                        <div class="col-lg-6 col-md-6 mb-3">
                            <h6 style="text-align:left;"><i class="fa fa-user-alt"></i> 名前（かな）</h6>
                            {{ Form::Text('name_kana', null, ['class' => 'form-control']) }}
                        </div>
                        <div class="col-lg-6 col-md-6 mb-3">
                            <h6 style="text-align:left;"><i class="fa fa-user-alt"></i> 名前（英字）</h6>
                            {{ Form::Text('name_roma', null, ['class' => 'form-control']) }}
                        </div>
                        <div class="col-lg-6 col-md-6 mb-3">
                            <h6 style="text-align:left;"><i class="fa fa-envelope"></i> Email</h6>
                            {{ Form::Text('email', null, ['class' => 'form-control']) }}
                        </div>
                        <div class="col-lg-6 col-md-6 mb-3">
                            <h6 style="text-align:left;"><i class="fa fa-user-plus"></i> 役職</h6>
                            {{ Form::Select('role', $aryRoleData, null, ['class' => 'form-control']) }}
                        </div>
                        <div class="col-lg-6 col-md-6 mb-3">
                            <h6 style="text-align:left;"><i class="fa fa-user-plus"></i> 部署</h6>
                            {{ Form::Select('department', $aryDptData, null, ['class' => 'form-control']) }}
                        </div>
                        <div class="col-lg-6 col-md-6 mb-3">
                            <h6 style="text-align:left;"><i class="far fa-clock"></i> 入社日 From〜To</h6>
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

        <button type="button" class="btn btn-primary float-right mb-3" onclick="location.href='{{ route('admin.employee.create') }}'">
            <i class="fas fa-plus"></i> 社員追加
        </button>

        <div class="ttl mb-3"><i class="fa fa-address-book"></i> 社員一覧</div>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-sm text-nowrap table-dark">
                <thead class="thead-dark">
                    <tr>
                        <th><i class="fa fa-address-book"></i> @sortablelink('employee_id', '社員ID')</th>
                        <th><i class="fa fa-user-alt"></i> @sortablelink('name_kana', '名前（かな）')</th>
                        <th><i class="fa fa-user-alt"></i> @sortablelink('name_roma', '名前（英字）')</th>
                        <th><i class="fa fa-user-plus"></i> @sortablelink('role', '役職')</th>
                        <th><i class="fa fa-user-plus"></i> @sortablelink('department', '部署')</th>
                        <th><i class="fa fa-envelope"></i> @sortablelink('email', 'Email')</th>
                        <th><i class="far fa-clock"></i> @sortablelink('created_at', '入社日')</th>
                        <th colspan="2"><i class="far fa-hand-paper"></i> 操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mixMembers as $Item)
                        <tr>
                            <td>{{ $Item['employee_id'] }}</td>
                            <td>{{ $Item['name_kana'] }}</td>
                            <td>{{ $Item['name_roma'] }}</td>
                            <td>{{ $Item['Role'] }}</td>
                            <td>{{ $Item['Dept'] }}</td>
                            <td>{{ $Item['email'] }}</td>
                            <td>{{ date('Y/m/d', strtotime($Item['created_at'])) }}</td>
                            <td align="center">
                                <button class="btn btn-success btn-sm" type="button" onclick="location.href='{{ route('admin.employee.edit', ['employee' => $Item['employee_id']]) }}'"><i class="fa fa-pen"></i> 編集</button>
                                <button class="btn btn-danger btn-sm" type="button" data-toggle="modal" data-target="#modal_delete" data-title="{{ $Item['name_kana'] }}" data-url="{{ route('admin.employee.destroy', ['employee' => $Item['employee_id']]) }}"><i class="fa fa-trash-alt"></i> 削除</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $mixMembers->appends(request()->query())->links() }}
        </div>

        {{-- モーダル --}}
        <div class="modal fade" data-backdrop="static" id="modal_delete" tabindex="-1" role="dialog" aria-hidden="true">
            <form method="POST" action="">
                @method('DELETE')
                @csrf
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">社員削除</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            以下の社員を削除しますか？
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
    $(function() {
        $('#modal_delete').on('shown.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var title = button.data('title');
            var url = button.data('url');
            var modal = $(this);
            modal.find('.modal-body p').eq(0).text('名前：' + title);
            modal.find('form').attr('action', url);
        });
    });
</script>
@endsection
