<?php

/**
 * Adminテーブルのリポジトリーファイル
 *
 * Adminテーブルとのやりとりに関連する処理を記載
 *
 * @version 1.0
 * @author K-Mori
 */

namespace App\Repositories;

use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Adminテーブルリポジトリー
 *
 * Adminテーブルとのやりとりに関連する処理を記載
 */
class AdminRepository implements AdminRepositoryInterface
{
    /**
     * 管理者データ取得
     *
     * @return void
     */
    public function selectAdminData()
    {
        return Admin::select()->sortable()->paginate(10);
    }

    /**
     * Undocumented function
     *
     * @param integer $id
     * @return void
     */
    public function selectAdminDataFromID($id)
    {
        return Admin::find($id);
    }

    /**
     * 管理者データ作成
     *
     * @param array $request
     * @return void
     */
    public function createAdminData($request)
    {

    }

    /**
     * 管理者データ更新
     *
     * @param array $request
     * @param integer $id
     * @return void
     */
    public function updateAdminData($request, $id)
    {
        $blnSuccessFlg = null;

        // DBトランザクション開始
        DB::beginTransaction();

        try {
            if (strlen($request['password']) > 0) {
                Admin::where('id', $id)->update([
                    'name' => $request['name'],
                    'login_id' => $request['login_id'],
                    'password' => Hash::make($request['password']),
                ]);
            } else {
                Admin::where('id', $id)->update([
                    'name' => $request['name'],
                    'login_id' => $request['login_id'],
                ]);
            }
            DB::commit();
            $blnSuccessFlg = true;
        } catch (\Exception $e) {
            DB::rollback();
            $blnSuccessFlg = false;
        }

        return $blnSuccessFlg;
    }

    /**
     * 管理者データ削除
     *
     * @param integer $id
     * @return void
     */
    public function deleteAdminData($id)
    {
        $blnSuccessFlg = null;

        // DBトランザクション開始
        DB::beginTransaction();

        try {
            Admin::where('id', $id)->delete();
            DB::commit();
            $blnSuccessFlg = true;
        } catch (\Exception $e) {
            DB::rollback();
            $blnSuccessFlg = false;
        }

        return $blnSuccessFlg;
    }

    /**
     * 管理者データ検索
     *
     * @param array $request
     * @return void
     */
    public function searchAdminData($request)
    {

    }
}
