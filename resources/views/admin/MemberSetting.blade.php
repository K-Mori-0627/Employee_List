@extends('layouts.admin.Base')

@section('Title', '社員設定')

@section('content')
<br />
<div class="container wrapper">
    <h2 class="heading" data-en="Member List"><i class="fa fa-address-book"></i><span> 社員リスト</span></h2>
    <button type="button" class="btn btn-primary float-right mb-3" onclick="location.href='{{ route('admin.member.create') }}'">
        社員追加
    </button>
    <div class="table-responsive">
        <table class="table table-striped table-hover table-sm text-nowrap table-dark">
            <thead class="thead-dark">
                <tr>
                    <th><i class="fa fa-address-book"></i> @sortablelink('member_id', '社員ID')</th>
                    <th><i class="fa fa-user-alt"></i> @sortablelink('name', '名前')</th>
                    <th><i class="fa fa-user-plus"></i> @sortablelink('role', '役職')</th>
                    <th colspan="2"><i class="far fa-hand-paper"></i> 操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mixMembers as $Item)
                <tr>
                    <td>{{ sprintf('%03d', $Item['member_id']) }}</td>
                    <td>{{ $Item['name'] }}</td>
                    <td>{{ $Item['caption'] }}</td>
                    <td align="right">
                        <button class="btn btn-success btn-sm" type="button" onclick="location.href='{{ route('admin.member.edit', ['member' => $Item['id']]) }}'"><i class="fa fa-pen"></i>編集</button>
                    </td>
                    <td>
                        <form action="{{ route('admin.member.destroy', ['member' => $Item['member_id']]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger btn-sm btn-dell" type="submit"><i class="fa fa-trash-alt"></i>削除</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $mixMembers->appends(request()->query())->links() }}
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(function() {
        $(".btn-dell").click(function() {
            if (!confirm("選択した社員を削除しますか？")) {
                return false;
            }
        });

        $(".btn-pw").click(function() {
            var letters = 'abcdefghijklmnopqrstuvwxyz';
            var numbers = '0123456789';

            var string  = letters + letters.toUpperCase() + numbers;

            var len = 8;
            var password='';

            for (var i = 0; i < len; i++) {
                password += string.charAt(Math.floor(Math.random() * string.length));
            }

            $('[name="Password"]').val(password);
        });
    });
</script>
@endsection
