<?php

/**
 * 管理者画面コントローラーのファイル
 *
 * 管理者画面に関連する処理を記載
 *
 * @version 1.0
 * @author K-Mori
 */

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Http\Controllers\Controller;
use App\Rules\PasswordRule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

/**
 * 管理者画面コントローラー
 *
 * 管理者画面に関連する処理を記載
 */
class HomeController extends Controller
{
    /**
     * コンストラクタ
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * 管理者画面初期表示
     *
     * @return 表示するblade
     */
    public function index()
    {
        // 団員データ取得
        $mixAdmins = Admin::select()->sortable()->paginate(10);

        return view('admin/home', compact('mixAdmins'));
    }

    /**
     * 管理者更新画面表示
     *
     * @param integer $id 管理者ID
     * @return 表示するblade
     */
    public function edit($id)
    {
        $mixAdmin = Admin::find($id);

        return view('admin/AdminEdit', compact('mixAdmin'));
    }

    /**
     * 管理者更新処理
     *
     * @param Request $_request 登録データ
     * @param integer $id 管理者ID
     * @return 表示するblade
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'max:20'],
            'login_id' => ['required', 'min:8', 'max:20'],
            'password' => ['nullable', 'min:8', 'max:15', new PasswordRule()],
        ]);

        $aryParams = $request->all();
        unset($aryParams['_token']);

        // DBトランザクション開始
        DB::beginTransaction();

        try {
            if (strlen($aryParams['password']) > 0) {
                Admin::where('id', $id)->update([
                    'name' => $aryParams['name'],
                    'login_id' => $aryParams['login_id'],
                    'password' => Hash::make($aryParams['password']),
                ]);
            } else {
                Admin::where('id', $id)->update([
                    'name' => $aryParams['name'],
                    'login_id' => $aryParams['login_id'],
                ]);
            }
            DB::commit();
            session()->flash('msg_success', '登録が完了しました。');
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('msg_error', '登録に失敗しました。');
        }

        return redirect()->route('admin.home.index');
    }

    /**
     * 管理者削除処理
     *
     * @param integer $id 削除データ
     * @return 表示するblade
     */
    public function destroy($id)
    {
        // DBトランザクション開始
        DB::beginTransaction();

        try {
            Admin::where('id', $id)->delete();
            DB::commit();
            session()->flash('msg_success', '削除が完了しました。');
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('msg_error', '削除に失敗しました。');
        }

        return redirect()->route('admin.home.index');
    }
}
