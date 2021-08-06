<?php

namespace App\Http\Utility;

use App\Models\CodeTable;

class Utility {

    /**
     * 役職データ取得関数
     *
     * @return array 役職データリスト
     */
    static public function GetRoleData()
    {
        $CodeTable = CodeTable::select('value', 'caption')
                                ->where('code_type', '役職')
                                ->orderBy('order', 'asc')
                                ->get();
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
    static public function GetDptData()
    {
        $CodeTable = CodeTable::select('value', 'caption')
                                ->where('code_type', '部署')
                                ->orderBy('order', 'asc')
                                ->get();
        $SelectList = array();
        $SelectList += array("" => "");

        foreach ($CodeTable as $Item) {
            $SelectList += array($Item->value => $Item->caption);
        }

        return $SelectList;
    }
}
