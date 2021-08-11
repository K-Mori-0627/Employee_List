<?php

/**
 * 社員一覧画面コントローラーのファイル
 *
 * 社員一覧画面に関連する処理を記載
 *
 * @version 1.0
 * @author K-Mori
 */

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\CodeTable;
use App\Models\Information;
use App\Rules\PasswordRule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        $this->middleware('auth:admin');
    }

    /**
     * 社員設定画面初期表示
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Query = User::query();

        // 団員データ取得
        $mixMembers = $Query->join('code_table', 'code_table.value', 'users.role')
                            ->where('code_type', '役職')
                            ->select('users.id', 'name', 'login_id', 'game_id', 'rank', 'caption', 'last_login_date')
                            ->sortable()->paginate(10);

        return view('admin/MemberSetting', compact('mixMembers'));
    }

    /**
     * 社員データ登録画面初期表示
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $CodeTable = new CodeTable();
        $aryRoleData = $CodeTable::GetRoleData();

        return view('admin/MemberRegister', compact('aryRoleData'));
    }

    /**
     * 社員データ登録関数
     *
     * @param Request $request 登録データ
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:20'],
            'role' => ['required'],
            'login_id' => ['required', 'min:8', 'max:20'],
            'password' => ['required', 'min:8', 'max:15', new PasswordRule()],
        ]);

        $aryParams = $request->all();
        unset($aryParams['_token']);

        // DBトランザクション開始
        DB::beginTransaction();

        try {
            User::create([
                'name' => $aryParams['name'],
                'role' => $aryParams['role'],
                'login_id' => $aryParams['login_id'],
                'password' => Hash::make($aryParams['password']),
                'profile_img' => "img/image.png",
                'freespace' => "よろしくお願いします。",
            ]);

            Information::create([
                'subject' => $aryParams['name'] . 'さんが入団しました！',
            ]);
            DB::commit();
            session()->flash('msg_success', '登録が完了しました。');
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('msg_error', '登録に失敗しました。');
        }

        return redirect()->route('admin.member.index');
    }

    /**
     * 社員データ編集画面初期表示
     *
     * @param integer $id 団員ID
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $CodeTable = new CodeTable();
        $aryRoleData = $CodeTable::GetRoleData();

        $mixProfile = User::find($id);

        return view('admin/MemberEdit', compact('aryRoleData', 'mixProfile'));
    }

    /**
     * 社員データ更新関数
     *
     * @param Request $request 更新データ
     * @param integer $id 団員ID
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'max:20'],
            'role' => ['required'],
            'login_id' => ['required', 'min:8', 'max:20'],
            'password' => ['nullable', 'min:8', 'max:15', new PasswordRule()],
        ]);

        $aryParams = $request->all();
        unset($aryParams['_token']);

        // DBトランザクション開始
        DB::beginTransaction();

        try {
            if (strlen($aryParams['password']) > 0) {
                User::where('id', $id)->update([
                    'name' => $aryParams['name'],
                    'role' => $aryParams['role'],
                    'login_id' => $aryParams['login_id'],
                    'password' => Hash::make($aryParams['password']),
                ]);
            } else {
                User::where('id', $id)->update([
                    'name' => $aryParams['name'],
                    'role' => $aryParams['role'],
                    'login_id' => $aryParams['login_id'],
                ]);
            }

            DB::commit();
            session()->flash('msg_success', '登録が完了しました。');
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('msg_error', '登録に失敗しました。');
        }

        return redirect()->route('admin.member.index');
    }

    /**
     * 団員データ削除関数
     *
     * @param integer $id 削除データ
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // DBトランザクション開始
        DB::beginTransaction();

        try {
            User::where('id', $id)->delete();
            DB::commit();
            session()->flash('msg_success', '削除が完了しました。');
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('msg_error', '削除に失敗しました。');
        }

        return redirect()->route('admin.member.index');
    }
}
