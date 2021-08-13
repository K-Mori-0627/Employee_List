<?php

/**
 * パスワード変更画面コントローラーのファイル
 *
 * パスワード変更画面に関連する処理を記載
 *
 * @version 1.0
 * @author K-Mori
 */

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\PasswordRule;
use App\Rules\CurrentPasswordRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * パスワード変更画面コントローラー
 *
 * パスワード変更画面に関連する処理を記載
 */
class PasswordController extends Controller
{
    /**
     * コンストラクタ
     */
    public function __construct()
    {
        $this->middleware('auth:user');
    }

    /**
     * パスワード変更画面初期表示
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user/Password');
    }

    /**
     * パスワード更新処理
     *
     * @param Request $request 登録データ
     * @param Integer $id ユーザーID
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'current' => ['required', 'min:8', 'max:15', new PasswordRule(), new CurrentPasswordRule()],
            'password' => ['required', 'min:8', 'max:15', 'confirmed', new PasswordRule()],
        ]);

        $aryParams = $request->all();
        unset($aryParams['_token']);

        // DBトランザクション開始
        DB::beginTransaction();

        try {
            User::where('id', $id)->update([
                'password' => Hash::make($aryParams['password']),
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
