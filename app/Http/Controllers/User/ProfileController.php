<?php

/**
 * プロフィール画面コントローラーのファイル
 *
 * プロフィール画面に関連する処理を記載
 *
 * @version 1.0
 * @author K-Mori
 */

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Employee;
use App\Http\Utility\Utility;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

/**
 * プロフィール画面コントローラー
 *
 * プロフィール画面に関連する処理を記載
 */
class ProfileController extends Controller
{
    /**
     * コンストラクタ
     */
    public function __construct()
    {
        $this->middleware('auth:user');
    }

    /**
     * プロフィール画面初期表示
     *
     * @param Integer $id ユーザーID
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Query = User::query();
        $mixProfile = $Query->join('employees', 'employees.employee_id', 'users.employee_id')
                            ->join('code_table', 'code_table.value', 'employees.role')
                            ->where('code_type', '役職')
                            ->where('users.employee_id', $id)
                            ->first();

        return view('user/Profile', compact('mixProfile'));
    }

    /**
     * プロフィール編集画面初期表示
     *
     * @param Integer $id ユーザーID
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mixProfile = User::find($id);

        $Utility = new Utility();
        $aryRoleData = $Utility::GetRoleData();

        return view('user/ProfileEdit', compact('mixProfile', 'aryRoleData'));
    }

    /**
     * プロフィール編集処理
     *
     * @param Integer $id ユーザーID
     * @param Request $request 登録データ
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'login_id' => ['required', 'min:8', 'max:20'],
            'birthday' => ['date'],
        ]);

        $aryParams = $request->all();
        unset($aryParams['_token']);

        // DBトランザクション開始
        DB::beginTransaction();

        try {
            User::where('employee_id', $id)->update([
                'login_id' => $aryParams['login_id'],
                'profile_img' => $aryParams['profile_img'],
            ]);

            Member::where('employee_id', $id)->update([
                'birthday' => $aryParams['birthday'],
                'technology' => $aryParams['technology'],
                'hobby' => $aryParams['hobby'],
                'freespace' => $aryParams['freespace'],
            ]);

            DB::commit();
            session()->flash('toastr', config('toastr.update'));
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('toastr', config('toastr.error'));
        }

        return redirect()->route('user.profile.show', $id);
    }
}
