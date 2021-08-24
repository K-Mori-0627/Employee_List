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

use App\Models\CodeTable;

/**
 * Adminテーブルリポジトリー
 *
 * Adminテーブルとのやりとりに関連する処理を記載
 */
class CodeTableRepository implements CodeTableRepositoryInterface
{
    /**
     * 役職データ取得関数
     *
     * @return array 役職データリスト
     */
    public function getRoleData()
    {
        $CodeTable = CodeTable::select('value', 'caption')
                              ->where('code_type', '役職')
                              ->orderBy('order', 'asc')->get();
        $SelectList = array();
        $SelectList += array("" => "");

        foreach ($CodeTable as $Item) {
            $SelectList += array($Item->value => $Item->caption);
        }

        return $SelectList;
    }

    /**
     * 部署データ取得関数
     *
     * @return array 役職データリスト
     */
    public function getDeptData()
    {
        $CodeTable = CodeTable::select('value', 'caption')
                              ->where('code_type', '部署')
                              ->orderBy('order', 'asc')->get();
        $SelectList = array();
        $SelectList += array("" => "");

        foreach ($CodeTable as $Item) {
            $SelectList += array($Item->value => $Item->caption);
        }

        return $SelectList;
    }
}
