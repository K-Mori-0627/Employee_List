@extends('layouts.admin.Base')

@section('Title', 'お知らせ設定')

@section('content')
    <br />
    <div class="container wrapper">
        <h2 class="heading" data-en="Information"><i class="fa fa-home"></i><span> お知らせ一覧</span></h2>
        <button type="button" class="btn btn-primary float-right mb-3" onclick="location.href='{{ route('admin.information.create') }}'">
            お知らせ追加
        </button>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-sm text-nowrap table-dark">
                <thead class="thead-dark">
                    <tr>
                        <th><i class="fa fa-address-book"></i> @sortablelink('id', 'No.')</th>
                        <th><i class="fa fa-user-alt"></i> @sortablelink('subject', 'タイトル')</th>
                        <th><i class="far fa-clock"></i> @sortablelink('created_at', '登録日')</th>
                        <th colspan="2"><i class="far fa-hand-paper"></i> 操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mixInfo as $Item)
                    <tr>
                        <td>{{ sprintf('%03d', $Item['id']) }}</td>
                        <td>{{ $Item['subject'] }}</td>
                        <td>{{ $Item['created_at'] }}</td>
                        <td align="right">
                            <button class="btn btn-success btn-sm" type="button" onclick="location.href='{{ route('admin.information.edit', ['information' => $Item['id']]) }}'"><i class="fa fa-pen"></i>編集</button>
                        </td>
                        <td>
                            <form action="{{ route('admin.information.destroy', ['information' => $Item['id']]) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger btn-sm btn-dell" type="submit"><i class="fa fa-trash-alt"></i>削除</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $mixInfo->appends(request()->query())->links() }}
        </div>
    </div>
@endsection

@section('script')
<script type="text/javascript">
    $(function() {
        $(".btn-dell").click(function() {
            if (!confirm("選択したお知らせを削除しますか？")) {
                return false;
            }
        });
    });
</script>
@endsection
