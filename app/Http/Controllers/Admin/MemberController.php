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

use App\Http\Utility\Utility;
use App\Models\User;
use App\Models\Employee;
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

        // 社員データ取得
        $mixMembers = $Query->join('employees', 'employees.employee_id', 'users.employee_id')
                            ->join('code_table', 'code_table.value', 'employees.role')
                            ->where('code_type', '役職')
                            ->select('users.employee_id', 'name_kana', 'name_roma', 'caption', 'email')
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
        $Utility = new Utility();
        $aryRoleData = $Utility::GetRoleData();
        $aryDptData = $Utility::GetDptData();

        return view('admin/MemberRegister', compact('aryRoleData', 'aryDptData'));
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
            'name_kana' => ['required', 'max:20'],
            'name_roma' => ['required', 'max:20'],
            'email' => ['required', 'email:strict,dns,spoof'],
            'login_id' => ['required', 'min:8', 'max:20'],
            'role' => ['required'],
            'department' => ['required'],
            'password' => ['required', 'min:8', 'max:15', new PasswordRule()],
        ]);

        $aryParams = $request->all();
        unset($aryParams['_token']);

        // DBトランザクション開始
        DB::beginTransaction();

        try {
            $strEmpId = str_pad(User::max('employee_id') + 1, 4, 0, STR_PAD_LEFT);

            User::create([
                'name_kana' => $aryParams['name_kana'],
                'name_roma' => $aryParams['name_roma'],
                'employee_id' => $strEmpId,
                'login_id' => $aryParams['login_id'],
                'password' => Hash::make($aryParams['password']),
                'profile_img' => "img/image.png",
            ]);

            Employee::create([
                'employee_id' => $strEmpId,
                'role' => $aryParams['role'],
                'department' => $aryParams['department'],
                'email' => $aryParams['email'],
            ]);

            Information::create([
                'title' => $aryParams['name_kana'] . 'さんが入団しました！',
                'text' => $aryParams['name_kana'] . 'さんが入団しました！',
            ]);
            DB::commit();
            session()->flash('toastr', config('toastr.save'));
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('toastr', config('toastr.error'));
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
        $Utility = new Utility();
        $aryRoleData = $Utility::GetRoleData();
        $aryDptData = $Utility::GetDptData();

        $Query = User::query();
        $mixProfile = $Query->join('employees', 'employees.employee_id', 'users.employee_id')
                            ->where('employees.employee_id', $id)->first();

        return view('admin/MemberEdit', compact('aryRoleData', 'aryDptData', 'mixProfile'));
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
            'name_kana' => ['required', 'max:20'],
            'name_roma' => ['required', 'max:20'],
            'email' => ['required', 'email:strict,dns,spoof'],
            'login_id' => ['required', 'min:8', 'max:20'],
            'role' => ['required'],
            'department' => ['required'],
            'password' => ['nullable', 'min:8', 'max:15', new PasswordRule()],
        ]);

        $aryParams = $request->all();
        unset($aryParams['_token']);

        // DBトランザクション開始
        DB::beginTransaction();

        try {
            if (strlen($aryParams['password']) > 0) {
                User::where('employee_id', $id)->update([
                    'name_kana' => $aryParams['name_kana'],
                    'name_roma' => $aryParams['name_roma'],
                    'login_id' => $aryParams['login_id'],
                    'password' => Hash::make($aryParams['password']),
                ]);
            } else {
                User::where('employee_id', $id)->update([
                    'name_kana' => $aryParams['name_kana'],
                    'name_roma' => $aryParams['name_roma'],
                    'login_id' => $aryParams['login_id'],
                ]);
            }

            Employee::where('employee_id', $id)->update([
                'role' => $aryParams['role'],
                'department' => $aryParams['department'],
                'email' => $aryParams['email'],
            ]);

            DB::commit();
            session()->flash('toastr', config('toastr.update'));
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('toastr', config('toastr.error'));
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
            User::where('employee_id', $id)->delete();
            Employee::where('employee_id', $id)->delete();
            DB::commit();
            session()->flash('toastr', config('toastr.delete'));
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('toastr', config('toastr.error'));
        }

        return redirect()->route('admin.member.index');
    }
}
