@extends('layouts.admin.Base')

@section('Title', 'ホーム')

@section('content')
    <br />
    <div class="container wrapper">
        <h2 class="heading" data-en="Home"><i class="fa fa-home"></i><span> ホーム</span></h2>
        <bootstrap-table-component models='@json($models)' />
        {{--
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
                        <td>{{ $Item['created_at'] }}</td>
                        <td align="right">
                            <button class="btn btn-success btn-sm" type="button" onclick="location.href='{{ route('admin.home.edit', ['home' => $Item['id']]) }}'"><i class="fa fa-pen"></i>編集</button>
                        </td>
                        <td>
                            <form action="{{ route('admin.home.destroy', ['home' => $Item['id']]) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger btn-sm btn-dell" type="submit"><i class="fa fa-trash-alt"></i>削除</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $mixAdmins->appends(request()->query())->links() }}
        </div>
        --}}
    </div>
@endsection

@section('script')
<script type="module">
    $(function() {
        $(".btn-dell").click(function() {
            if (!confirm("選択した管理者を削除しますか？")) {
                return false;
            }
        });
    });
</script>
@endsection
