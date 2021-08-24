<?php

/**
 * Userテーブルのリポジトリーファイル
 *
 * Userテーブルとのやりとりに関連する処理を記載
 *
 * @version 1.0
 * @author K-Mori
 */

namespace App\Repositories;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Userテーブルリポジトリー
 *
 * Userテーブルとのやりとりに関連する処理を記載
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * 社員数取得
     *
     * @return integer 社員数
     */
    public function countUser()
    {
        return User::count();
    }

    /**
     * 社員リスト取得
     *
     * @return void
     */
    public function getEmployeeList()
    {
        $mixManageDept = User::join('employees as emp', 'emp.employee_id', 'users.employee_id')->where('emp.department', '0')
                             ->join('code_table as role', 'role.value', 'emp.role')->where('role.code_type', '役職')
                             ->join('code_table as dept', 'dept.value', 'emp.department')->where('dept.code_type', '部署')
                             ->select('users.employee_id', 'users.name_kana', 'role.caption as Role', 'dept.caption as Dept', 'profile_img')
                             ->orderByRaw('dept.order', 'emp.employee_id')
                             ->get();

        $mixSalesDept = User::join('employees as emp', 'emp.employee_id', 'users.employee_id')->where('emp.department', '1')
                            ->join('code_table as role', 'role.value', 'emp.role')->where('role.code_type', '役職')
                            ->join('code_table as dept', 'dept.value', 'emp.department')->where('dept.code_type', '部署')
                            ->select('users.employee_id', 'users.name_kana', 'role.caption as Role', 'dept.caption as Dept', 'profile_img')
                            ->orderByRaw('dept.order', 'emp.employee_id')
                            ->get();

        $mixEastDept = User::join('employees as emp', 'emp.employee_id', 'users.employee_id')->where('emp.department', '2')
                           ->join('code_table as role', 'role.value', 'emp.role')->where('role.code_type', '役職')
                           ->join('code_table as dept', 'dept.value', 'emp.department')->where('dept.code_type', '部署')
                           ->select('users.employee_id', 'users.name_kana', 'role.caption as Role', 'dept.caption as Dept', 'profile_img')
                           ->orderByRaw('dept.order', 'emp.employee_id')
                           ->get();

        $mixWestDept = User::join('employees as emp', 'emp.employee_id', 'users.employee_id')->where('emp.department', '3')
                           ->join('code_table as role', 'role.value', 'emp.role')->where('role.code_type', '役職')
                           ->join('code_table as dept', 'dept.value', 'emp.department')->where('dept.code_type', '部署')
                           ->select('users.employee_id', 'users.name_kana', 'role.caption as Role', 'dept.caption as Dept', 'profile_img')
                           ->orderByRaw('dept.order', 'emp.employee_id')
                           ->get();

        return [$mixManageDept, $mixSalesDept, $mixEastDept, $mixWestDept];
    }

    /**
     * ユーザーデータ取得
     *
     * @param integer $id
     * @return void
     */
    public function getUserData($id)
    {
        return User::join('employees', 'employees.employee_id', 'users.employee_id')
                   ->where('employees.employee_id', $id)->first();
    }

    /**
     * 社員データ取得
     *
     * @param integer $id
     * @return void
     */
    public function selectProfileData($id)
    {
        return User::join('employees as emp', 'emp.employee_id', 'users.employee_id')->where('users.employee_id', $id)
                   ->join('code_table as role', 'role.value', 'emp.role')->where('role.code_type', '役職')
                   ->join('code_table as dept', 'dept.value', 'emp.department')->where('dept.code_type', '部署')
                   ->select('users.employee_id', 'name_kana', 'name_roma', 'role.caption as Role', 'dept.caption As Dept', 'email', 'birthday', 'technology', 'hobby', 'freespace', 'profile_img', 'users.created_at')
                   ->first();
    }

    /**
     * 社員データ取得（ID検索）
     *
     * @param integer $id
     * @return void
     */
    public function selectProfileDataFromID($id)
    {
        return User::find($id);
    }

    /**
     * 社員データ更新
     *
     * @param array $request
     * @param integer $id
     * @return void
     */
    public function updateProfileData($request, $id)
    {
        $blnSuccessFlg = null;

        // DBトランザクション開始
        DB::beginTransaction();

        try {
            User::where('employee_id', $id)->update([
                'login_id' => $request['login_id'],
                'profile_img' => $request['profile_img'],
            ]);

            Employee::where('employee_id', $id)->update([
                'birthday' => $request['birthday'],
                'technology' => $request['technology'],
                'hobby' => $request['hobby'],
                'freespace' => $request['freespace'],
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
     * パスワード更新
     *
     * @param array $request
     * @param integer $id
     * @return void
     */
    public function updatePassword($request, $id)
    {
        $blnSuccessFlg = null;

        // DBトランザクション開始
        DB::beginTransaction();

        try {
            User::where('id', $id)->update([
                'password' => Hash::make($request['password']),
            ]);
            DB::commit();
            $blnSuccessFlg = true;
        } catch (\Exception $e) {
            DB::rollback();
            $blnSuccessFlg = false;
        }

        return $blnSuccessFlg;
    }
}
