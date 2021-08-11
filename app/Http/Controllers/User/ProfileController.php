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
use App\Models\Member;
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
        $mixProfile = $Query->join('members', 'members.member_id', 'users.member_id')
                            ->join('code_table', 'code_table.value', 'members.role')
                            ->where('code_type', '役職')
                            ->where('users.member_id', $id)
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
            'name' => ['required', 'max:20'],
        ]);

        $aryParams = $request->all();
        unset($aryParams['_token']);

        // DBトランザクション開始
        DB::beginTransaction();

        try {
            User::where('id', $id)->update([
                'name' => $aryParams['name'],
                'login_id' => $aryParams['login_id'],
                'hobby' => $aryParams['hobby'],
                'freespace' => $aryParams['freespace'],
                'profile_img' => $aryParams['profile_img'],
            ]);

            DB::commit();
            session()->flash('msg_success', '登録が完了しました。');
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('msg_error', '登録に失敗しました。');
        }

        return redirect()->route('user.profile.show', $id);
    }
}
