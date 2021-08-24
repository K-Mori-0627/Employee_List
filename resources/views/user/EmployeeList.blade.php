@extends('layouts.user.Base')

@section('Title', '社員リスト')

@section('content')
    <br />
    <div class="container wrapper">
        <h2 class="heading" data-en="Employee List"><i class="fa fa-address-book"></i><span> 社員リスト</span></h2>

        <div class="mb-3" align="center">管理部</div>
        <div class="member_box row">
            @foreach ($mixManageDept as $Item)
                <div class="sortable" id="{{ $Item['employee_id'] }}">
                    <div class="member" id="{{ $Item['employee_id'] }}">
                        <p>{{ $Item['Role'] }}</p>
                        <a href="{{ route('user.profile.show', ['profile' => $Item['employee_id']]) }}">
                            <p class="trim"><img src="{{ asset($Item['profile_img']) }}"></p>
                            <p>{{ $Item['name_kana'] }}</p>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mb-3" align="center">営業部</div>
        <div class="member_box row">
            @foreach ($mixSalesDept as $Item)
                <div class="sortable" id="{{ $Item['employee_id'] }}">
                    <div class="member" id="{{ $Item['employee_id'] }}">
                        <p>{{ $Item['Role'] }}</p>
                        <a href="{{ route('user.profile.show', ['profile' => $Item['employee_id']]) }}">
                            <p class="trim"><img src="{{ asset($Item['profile_img']) }}"></p>
                            <p>{{ $Item['name_kana'] }}</p>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mb-3" align="center">関東支部</div>
        <div class="member_box row">
            @foreach ($mixEastDept as $Item)
                <div class="sortable" id="{{ $Item['employee_id'] }}">
                    <div class="member" id="{{ $Item['employee_id'] }}">
                        <p>{{ $Item['Role'] }}</p>
                        <a href="{{ route('user.profile.show', ['profile' => $Item['employee_id']]) }}">
                            <p class="trim"><img src="{{ asset($Item['profile_img']) }}"></p>
                            <p>{{ $Item['name_kana'] }}</p>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mb-3" align="center">関西支部</div>
        <div class="member_box row">
            @foreach ($mixWestDept as $Item)
                <div class="sortable" id="{{ $Item['employee_id'] }}">
                    <div class="member" id="{{ $Item['employee_id'] }}">
                        <p>{{ $Item['Role'] }}</p>
                        <a href="{{ route('user.profile.show', ['profile' => $Item['employee_id']]) }}">
                            <p class="trim"><img src="{{ asset($Item['profile_img']) }}"></p>
                            <p>{{ $Item['name_kana'] }}</p>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
