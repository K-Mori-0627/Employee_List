<?php

/**
 * Employeeテーブルのリポジトリーファイル
 *
 * Employeeテーブルとのやりとりに関連する処理を記載
 *
 * @version 1.0
 * @author K-Mori
 */

namespace App\Repositories;

use App\Models\User;
use App\Models\Employee;
use App\Models\Information;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Employeeテーブルリポジトリー
 *
 * Employeeテーブルとのやりとりに関連する処理を記載
 */
class EmployeeRepository implements EmployeeRepositoryInterface
{
    /**
     * 社員データ取得
     *
     * @return mixed 社員データ
     */
    public function selectEmployeeData()
    {
        // 社員データ取得
        $mixMembers = User::join('employees as emp', 'emp.employee_id', 'users.employee_id')
                          ->join('code_table as role', 'role.value', 'emp.role')->where('role.code_type', '役職')
                          ->join('code_table as dept', 'dept.value', 'emp.department')->where('dept.code_type', '部署')
                          ->select('users.employee_id', 'name_kana', 'name_roma', 'role.caption as Role', 'dept.caption As Dept', 'email', 'users.created_at')
                          ->sortable()->paginate(10);

        return $mixMembers;
    }

    /**
     * 社員データ作成
     *
     * @param array $request
     * @return void
     */
    public function createEmployeeData($request)
    {
        $blnSuccessFlg = null;

        // DBトランザクション開始
        DB::beginTransaction();

        try {
            $strEmpId = str_pad(User::max('employee_id') + 1, 4, 0, STR_PAD_LEFT);

            User::create([
                'name_kana' => $request['name_kana'],
                'name_roma' => $request['name_roma'],
                'employee_id' => $strEmpId,
                'login_id' => $request['login_id'],
                'password' => Hash::make($request['password']),
                'profile_img' => "img/image.png",
            ]);

            Employee::create([
                'employee_id' => $strEmpId,
                'role' => $request['role'],
                'department' => $request['department'],
                'email' => $request['email'],
            ]);

            Information::create([
                'title' => $request['name_kana'] . 'さんが入社しました！',
                'text' => $request['name_kana'] . 'さんが入社しました！',
            ]);

            DB::commit();
            $blnSuccessFlg = true;
        } catch (\Exception $e) {
            DB::rollback();
            $blnSuccessFlg = false;
        }

        return $blnSuccessFlg;
    }

    /**
     * 社員データ更新
     *
     * @param array $request
     * @param integer $id
     * @return void
     */
    public function updateEmployeeData($request, $id)
    {
        $blnSuccessFlg = null;

        // DBトランザクション開始
        DB::beginTransaction();

        try {
            if (strlen($request['password']) > 0) {
                User::where('employee_id', $id)->update([
                    'name_kana' => $request['name_kana'],
                    'name_roma' => $request['name_roma'],
                    'login_id' => $request['login_id'],
                    'password' => Hash::make($request['password']),
                ]);
            } else {
                User::where('employee_id', $id)->update([
                    'name_kana' => $request['name_kana'],
                    'name_roma' => $request['name_roma'],
                    'login_id' => $request['login_id'],
                ]);
            }

            Employee::where('employee_id', $id)->update([
                'role' => $request['role'],
                'department' => $request['department'],
                'email' => $request['email'],
            ]);

            DB::commit();
            $blnSuccessFlg = true;
        } catch (\Exception $e) {
            DB::rollback();
            $blnSuccessFlg = false;
        }

        return $blnSuccessFlg;
    }

    /**
     * 社員データ削除
     *
     * @param integer $id
     * @return void
     */
    public function deleteEmployeeData($id)
    {
        $blnSuccessFlg = null;

        // DBトランザクション開始
        DB::beginTransaction();

        try {
            User::where('employee_id', $id)->delete();
            Employee::where('employee_id', $id)->delete();
            DB::commit();
            $blnSuccessFlg = true;
        } catch (\Exception $e) {
            DB::rollback();
            $blnSuccessFlg = false;
        }

        return $blnSuccessFlg;
    }

    /**
     * 社員データ検索
     *
     * @param array $request
     * @return void
     */
    public function searchEmployeeData($request)
    {

    }
}
