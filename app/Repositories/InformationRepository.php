<?php

/**
 * Informationテーブルのリポジトリーファイル
 *
 * Informationテーブルとのやりとりに関連する処理を記載
 *
 * @version 1.0
 * @author K-Mori
 */

namespace App\Repositories;

use App\Models\Information;
use Illuminate\Support\Facades\DB;

/**
 * Informationテーブルリポジトリー
 *
 * Informationテーブルとのやりとりに関連する処理を記載
 */
class InformationRepository implements InformationRepositoryInterface
{
    /**
     * 全お知らせデータ取得
     *
     * @return mixed お知らせデータ
     */
    public function getAllInformationData()
    {
        return Information::orderby('created_at', 'desc')->get();
    }

    /**
     * 全お知らせデータ取得（パジネート）
     *
     * @return mixed お知らせデータ
     */
    public function selectInformationData()
    {
        return Information::select()->sortable()->paginate(10);
    }

    /**
     * 全お知らせデータ取得（ID検索）
     *
     * @return mixed お知らせデータ
     */
    public function selectInformationDataFromID($id)
    {
        return Information::find($id);
    }

    /**
     * 全お知らせデータ取得（件数5件）
     *
     * @return mixed お知らせデータ
     */
    public function selectInformationDataTake5()
    {
        return Information::orderby('created_at', 'desc')->take(5)->get();
    }

    /**
     * お知らせデータ作成
     *
     * @param array $request
     * @return void
     */
    public function createInformationData($request)
    {
        $blnSuccessFlg = null;

        // DBトランザクション開始
        DB::beginTransaction();

        try {
            Information::create([
                'title' => $request['title'],
                'text' => $request['text'],
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
     * お知らせデータ更新
     *
     * @param array $request
     * @param integer $id
     * @return void
     */
    public function updateInformationData($request, $id)
    {
        $blnSuccessFlg = null;

        // DBトランザクション開始
        DB::beginTransaction();

        try {
            Information::where('id', $id)->update([
                'title' => $request['title'],
                'text' => $request['text'],
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
     * お知らせデータ削除
     *
     * @param integer $id
     * @return void
     */
    public function deleteInformationData($id)
    {
        $blnSuccessFlg = null;

        // DBトランザクション開始
        DB::beginTransaction();

        try {
            Information::where('id', $id)->delete();
            DB::commit();
            $blnSuccessFlg = true;
        } catch (\Exception $e) {
            DB::rollback();
            $blnSuccessFlg = false;
        }

        return $blnSuccessFlg;
    }

    /**
     * お知らせデータ検索
     *
     * @param array $request
     * @return void
     */
    public function searchInformationData($request)
    {

    }

}
