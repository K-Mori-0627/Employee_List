<?php

/**
 * 社員一覧画面コントローラーのファイル
 *
 * 社員一覧画面に関連する処理を記載
 *
 * @version 1.0
 * @author K-Mori
 */

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Employee;
use App\Http\Controllers\Controller;

/**
 * 社員一覧画面コントローラー
 *
 * 社員一覧画面に関連する処理を記載
 */
class MemberController extends Controller
{
    /**
     * コンストラクタ
     */
    public function __construct()
    {
        $this->middleware('auth:user');
    }

    /**
     * 社員一覧画面初期表示
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Query = User::query();

        // 団員データ取得
        $mixMembers = $Query->join('employees', 'employees.employee_id', 'users.employee_id')
                            ->join('code_table', 'code_table.value', 'employees.department')
                            ->where('code_type', '部署')
                            ->select('users.employee_id', 'users.name_kana', 'caption', 'profile_img')
                            ->get();

        $mixLeader = User::select('employee_id', 'name_kana', 'profile_img')->get();
        $mixSubLeader = User::select('employee_id', 'name_kana', 'profile_img')->get();
        $mixAtkLeader = User::select('employee_id', 'name_kana', 'profile_img')->get();
        $mixDefLeader = User::select('employee_id', 'name_kana', 'profile_img')->get();

        return view('user/MemberList', compact('mixLeader', 'mixSubLeader', 'mixAtkLeader', 'mixDefLeader'));
    }
}
